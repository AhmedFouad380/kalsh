<?php

namespace App\Http\Controllers\Api\Provider;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\CarService;
use App\Models\Chat;
use App\Models\Message;
use App\Models\Notification;
use App\Models\Offer;
use App\Models\Order;
use App\Models\Provider;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class DeliveryServiceController extends Controller
{
    public function acceptOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => ['required', Rule::exists('orders', 'id')->whereIn('type', ['delivery', 'package'])->where(function ($query) {
                $query->where('status_id', Status::PENDING_STATUS);
            })]
        ]);
        if (!is_array($validator) && $validator->fails()) {
            return callback_data(error(), $validator->errors()->first());
        }
        $provider = Auth::guard('provider')->user();
        $order = Order::findOrFail($request->order_id);

        // create chat
        $chat = Chat::firstOrCreate([
            'order_id' => $order->id,
            'user_id' => $order->user_id,
            'provider_id' => Auth::guard('provider')->id(),
        ], [
            'order_id' => $order->id,
            'user_id' => $order->user_id,
            'provider_id' => Auth::guard('provider')->id(),
            'type' => 'from_user'
        ]);

        // create messages if not exists
        if (!$chat->messages()->exists()) {
            // 1- order description
            Message::create([
                'chat_id' => $chat->id,
                'sender_type' => User::class,
                'sender_id' => $order->user_id,
                'message' => $order->description,
                'voice' => $order->voice,
            ]);
        }

        // accept offer
        $order->status_id = Status::ACCEPTED_STATUS;
        $order->provider_id = $provider->id;
        $order->provider_lat = $provider->lat;
        $order->provider_lng = $provider->lng;
        $order->save();

        // send notification to user
        $user = $order->user;
        $title_ar = 'قبول الطلب';
        $title_en = 'Order Accept';
        $msg_ar = "تم قبول طلبك رقم #{$order->id}" . "بواسطة مقدم الخدمة {$provider->name}";
        $msg_en = "You order #{$order->id} has been accepted by provider {$provider->name}";
        sendToProvider([$user->device_token], ${'title_' . $user->lang}, ${'msg_' . $user->lang}, Notification::ACCEPT_ORDER_TYPE, $order->id, $order->type);

        Notification::create([
            'type' => Notification::ACCEPT_ORDER_TYPE,
            'notifiable_type' => User::class,
            'notifiable_id' => $user->id,
            'order_id' => $order->id,
            'title_ar' => $title_ar,
            'title_en' => $title_en,
            'description_ar' => $msg_ar,
            'description_en' => $msg_en,
        ]);

        return callback_data(success(), 'order_accepted_successfully');
    }

    public function StartOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => ['required', Rule::exists('orders', 'id')->where(function ($query) {
                $query->where('status_id', Status::ACCEPTED_STATUS)->where('provider_id', Auth::guard('provider')->id());
            })]
        ]);
        if (!is_array($validator) && $validator->fails()) {
            return callback_data(error(), $validator->errors()->first());
        }

        $provider = Auth::guard('provider')->user();
        $order = Order::findOrFail($request->order_id);
        // get accepted offer
        $offer = Offer::where('order_id', $order->id)
            ->where('provider_id', $provider->id)
            ->where('status_id', Status::START_STATUS)
            ->first();

        if (!$offer) {
            return callback_data(error(), 'offer_not_found');
        }

        // accept offer
        $order->status_id = Status::START_STATUS;
        $order->provider_id = $provider->id;
        $order->save();

        // send notification to user
        $user = $order->user;

        $title_ar = 'بدا الطلب';
        $title_en = 'Order Started';
        $msg_ar = "تم بدا طلبك رقم #{$order->id}" . "بواسطة مقدم الخدمة {$provider->name}";
        $msg_en = "You order #{$order->id} has been Started by provider {$provider->name}";
        sendToProvider([$user->device_token], ${'title_' . $user->lang}, ${'msg_' . $user->lang}, Notification::ACCEPT_ORDER_TYPE, $order->id, $order->type);

        Notification::create([
            'type' => Notification::ACCEPT_ORDER_TYPE,
            'notifiable_type' => User::class,
            'notifiable_id' => $user->id,
            'order_id' => $order->id,
            'title_ar' => $title_ar,
            'title_en' => $title_en,
            'description_ar' => $msg_ar,
            'description_en' => $msg_en,
        ]);

        return callback_data(success(), 'order_accepted_successfully');
    }

    public function rejectOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => ['required', Rule::exists('orders', 'id')->where(function ($query) {
                $query->where('status_id', Status::PENDING_STATUS);
            })],
        ]);
        if (!is_array($validator) && $validator->fails()) {
            return callback_data(error(), $validator->errors()->first());
        }
        // check if offer sent before
        $offerExists = Offer::where('order_id', $request->order_id)->where('status_id', Status::REJECTED_BY_PROVIDER_STATUS)
            ->where('provider_id', Auth::guard('provider')->id())
            ->first();
        if ($offerExists) {
            return callback_data(error(), 'order_rejected_before');
        }
        //send reject offer
        Offer::create([
            'order_id' => $request->order_id,
            'provider_id' => Auth::guard('provider')->id(),
            'status_id' => Status::CANCELED_BY_PROVIDER_STATUS,
        ])->refresh();
        return callback_data(success(), 'order_rejected_successfully');
    }

    public function updateCost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => ['required', Rule::exists('orders', 'id')->where(function ($query) {
                $query->where('status_id', Status::ACCEPTED_STATUS);
            })],
            'order_cost' => 'required|numeric|min:0'
        ]);
        if (!is_array($validator) && $validator->fails()) {
            return callback_data(error(), $validator->errors()->first());
        }
        $provider = Auth::guard('provider')->user();

        // add price to order  ...
        $order = Order::findOrFail($request->order_id);
        $order->order_cost = $request->order_cost;
        $order->total_price = $order->price + $request->order_cost;
        $order->save();

        //send notification to user ...
        // send notification to user
        $user = $order->user;
        $title_ar = 'تحديث سعر الطلب';
        $title_en = 'Update Order Price';
        $msg_ar = "تم تحديث سعر  الطلبك رقم #{$order->id}" . "بواسطة مقدم الخدمة {$provider->name}";
        $msg_en = "You order #{$order->id} the price has been updated by provider {$provider->name}";
        sendToProvider([$user->device_token], ${'title_' . $user->lang}, ${'msg_' . $user->lang}, Notification::ORDER_UPDATE_PRICE, $order->id, $order->type);

        Notification::create([
            'type' => Notification::ORDER_UPDATE_PRICE,
            'notifiable_type' => User::class,
            'notifiable_id' => $user->id,
            'order_id' => $order->id,
            'title_ar' => $title_ar,
            'title_en' => $title_en,
            'description_ar' => $msg_ar,
            'description_en' => $msg_en,
        ]);
        return callback_data(success(), 'order_price_updated_successfully');
    }

    public function completeOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => ['required', Rule::exists('orders', 'id')->where(function ($query) {
                $query->where('status_id', Status::ACCEPTED_STATUS)
                    ->where('provider_id', Auth::guard('provider')
                        ->id());
            })]
        ]);
        if (!is_array($validator) && $validator->fails()) {
            return callback_data(error(), $validator->errors()->first());
        }

        $provider = Auth::guard('provider')->user();
        // complete order
        $order = Order::findOrFail($request->order_id);
        $order->status_id = Status::COMPLETED_STATUS;
        $order->save();

        // send notification to user
        $user = $order->user;

        $title_ar = 'الطلب أكتمل';
        $title_en = 'Order Completed';
        $msg_ar = "تم أكتمال الطلب رقم #{$order->id}" . "بواسطة مقدم الخدمة {$provider->name}";
        $msg_en = "You order #{$order->id} has been completed by provider {$provider->name}";
        sendToProvider([$user->device_token], ${'title_' . $user->lang}, ${'msg_' . $user->lang}, Notification::COMPLETE_ORDER_TYPE, $order->id, $order->type);

        Notification::create([
            'type' => Notification::COMPLETE_ORDER_TYPE,
            'notifiable_type' => User::class,
            'notifiable_id' => $user->id,
            'order_id' => $order->id,
            'title_ar' => $title_ar,
            'title_en' => $title_en,
            'description_ar' => $msg_ar,
            'description_en' => $msg_en,
        ]);
        return callback_data(success(), 'order_completed_successfully');
    }

    public function orderDetails(Request $request){
        $data = $request->all();
        $validator = Validator::make($data, [
            'order_id' => 'required|exists:orders,id,provider_id,' . Auth::guard('provider')->id(),
        ]);
        if (!is_array($validator) && $validator->fails()) {
            return callback_data(error(), $validator->errors()->first());
        }
        $orders = OrderResource::make(Order::find($request->order_id))
        ;
        return callback_data(success(),'my_orders',$orders);

    }


}
