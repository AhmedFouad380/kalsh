<?php

namespace App\Http\Controllers\Api\Provider;

use App\Helpers\ResearchProvidersTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Http\Resources\ProviderResource;
use App\Models\Chat;
use App\Models\Message;
use App\Models\Notification;
use App\Models\Offer;
use App\Models\Order;
use App\Models\Provider;
use App\Models\Rate;
use App\Models\Service;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class LimousineServiceOrderController extends Controller
{
    use ResearchProvidersTrait;

    public function acceptOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => ['required',
                Rule::exists('orders', 'id')->where(function ($query) {
                    $query->where('status_id', Status::PENDING_STATUS)
                        ->where('service_id', 2)
                        ->whereNull('provider_id');
                })]
        ]);
        if (!is_array($validator) && $validator->fails()) {
            return callback_data(error(), $validator->errors()->first());
        }
        $order = Order::findOrFail($request->order_id);

        // accept offer
        $order->status_id = Status::ACCEPTED_STATUS;
        $order->provider_id = Auth::guard('provider')->id();
        $order->save();
        //delete offers of this order
        Offer::where('order_id', $order->id)->delete();
        $user = $order->user;

        $title_ar = 'قبول الطلب';
        $title_en = 'Order Accept';
        $msg_ar = 'تم قبول طلبك رقم ' . '#' . $order->id;
        $msg_en = 'Your order #' . $order->id . ' has been accepted';
        sendToProvider([$user->device_token], ${'title_' . $user->lang}, ${'msg_' . $user->lang}, Notification::ACCEPT_OFFER_TYPE, $order->id, @optional($order)->type);

        Notification::create([
            'type' => Notification::ACCEPT_OFFER_TYPE,
            'notifiable_type' => User::class,
            'notifiable_id' => $user->id,
            'order_id' => $order->id,
            'title_ar' => $title_ar,
            'title_en' => $title_en,
            'description_ar' => $msg_ar,
            'description_en' => $msg_en,
        ]);

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


        return callback_data(success(), 'order_accepted_successfully');
    }

    public function rejectOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => ['required', Rule::exists('orders', 'id')->where(function ($query) {
                $query->where('status_id', Status::PENDING_STATUS)
                    ->where('service_id', 2)
                    ->whereNull('provider_id');
            })],
        ]);
        if (!is_array($validator) && $validator->fails()) {
            return callback_data(error(), $validator->errors()->first());
        }
        // check if offer sent before
        $offerExists = Offer::where('order_id', $request->order_id)
            ->where('provider_id', Auth::guard('provider')->id())
            ->where('status_id', Status::REJECTED_BY_PROVIDER_STATUS)
            ->first();
        if ($offerExists) {
            return callback_data(error(), 'order_rejected_before');
        }
        //send reject offer
        Offer::create([
            'order_id' => $request->order_id,
            'provider_id' => Auth::guard('provider')->id(),
            'status_id' => Status::REJECTED_BY_PROVIDER_STATUS,
        ]);
        return callback_data(success(), 'order_rejected_successfully');
    }

    public function startOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => ['required', Rule::exists('orders', 'id')->where(function ($query) {
                $query->where('status_id', Status::ACCEPTED_STATUS)
                    ->where('service_id', 2)
                    ->where('provider_id', Auth::guard('provider')->id());
                //
            })],
        ]);
        if (!is_array($validator) && $validator->fails()) {
            return callback_data(error(), $validator->errors()->first());
        }
        // check if offer sent before
        $order = Order::findOrFail($request->order_id);
        $order->status_id = Status::START_STATUS;
        $order->save();

        $user = $order->user;
        $provider = Auth::guard('provider')->user();

        $title_ar = 'بدا الطلب';
        $title_en = 'Order Started';
        $msg_ar = "تم بدا طلبك رقم #{$order->id}" . "بواسطة مقدم الخدمة {$provider->name}";
        $msg_en = "You order #{$order->id} has been Started by provider {$provider->name}";
        sendToProvider([$user->device_token], ${'title_' . $user->lang}, ${'msg_' . $user->lang}, Notification::START_ORDER_TYPE, $order->id, $order->type);

        Notification::create([
            'type' => Notification::START_ORDER_TYPE,
            'notifiable_type' => User::class,
            'notifiable_id' => $user->id,
            'order_id' => $order->id,
            'title_ar' => $title_ar,
            'title_en' => $title_en,
            'description_ar' => $msg_ar,
            'description_en' => $msg_en,
        ]);
        return callback_data(success(), 'order_started_successfully');
    }

    public function arrivedOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => ['required', Rule::exists('orders', 'id')->where(function ($query) {
                $query->where('status_id', Status::START_STATUS)
                    ->where('service_id', 2)
                    ->where('provider_id', Auth::guard('provider')->id());
                //
            })],
        ]);
        if (!is_array($validator) && $validator->fails()) {
            return callback_data(error(), $validator->errors()->first());
        }
        // check if offer sent before
        $order = Order::findOrFail($request->order_id);
        $order->status_id = Status::ARRIVED_STATUS;
        $order->save();

        $user = $order->user;
        $provider = Auth::guard('provider')->user();

        $title_ar = 'الوصول للعميل';
        $title_en = 'arrived to client';
        $msg_ar = "تم وصول سيارة طلبك رقم #{$order->id}" . "بواسطة مقدم الخدمة {$provider->name}";
        $msg_en = "Your car`s order #{$order->id} has been Started by provider {$provider->name}";
        sendToProvider([$user->device_token], ${'title_' . $user->lang}, ${'msg_' . $user->lang}, Notification::ARRIVED_ORDER_TYPE, $order->id, $order->type);

        Notification::create([
            'type' => Notification::ARRIVED_ORDER_TYPE,
            'notifiable_type' => User::class,
            'notifiable_id' => $user->id,
            'order_id' => $order->id,
            'title_ar' => $title_ar,
            'title_en' => $title_en,
            'description_ar' => $msg_ar,
            'description_en' => $msg_en,
        ]);
        return callback_data(success(), 'order_arrived_successfully');
    }

    public function completeOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => ['required', Rule::exists('orders', 'id')->where(function ($query) {
                $query->where('status_id', Status::ARRIVED_STATUS)
                    ->where('service_id', 2)
                    ->where('provider_id', Auth::guard('provider')->id());
            })],
            'distance' => ['required', 'numeric']
        ]);
        if (!is_array($validator) && $validator->fails()) {
            return callback_data(error(), $validator->errors()->first());
        }

        $order = Order::findOrFail($request->order_id);


        // accept order
        $order->status_id = Status::COMPLETED_STATUS;
        $order->save();

        // send notification to provider
        $user = $order->user;
        $title_ar = 'انتهاء الطلب';
        $title_en = 'Order complete';
        $msg_ar = 'تم انتهاء طلبك رقم ' . '#' . $order->id;
        $msg_en = 'Your order #' . $order->id . ' has been completed';
        sendToProvider([$user->device_token], ${'title_' . $user->lang}, ${'msg_' . $user->lang}, Notification::COMPLETE_ORDER_TYPE, $order->id, @optional($order)->type);


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

        $price = $this->carTypeTotalPrice($order->car_type_id, $request->distance);
        $order->price = $price;
        $order->distance = $request->distance;
        $order->save();
        $data = new OrderResource($order);
        return callback_data(success(), 'order_completed_successfully', $data);
    }


}
