<?php

namespace App\Http\Controllers\Api\Provider;

use App\Http\Controllers\Controller;
use App\Models\CarService;
use App\Models\Notification;
use App\Models\Offer;
use App\Models\Order;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CarServiceController extends Controller
{
    public function acceptOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => ['required', Rule::exists('orders', 'id')->where(function ($query) {
                $query->where('status_id', Status::PENDING_STATUS);
            })]
        ]);
        if (!is_array($validator) && $validator->fails()) {
            return callback_data(error(), $validator->errors()->first());
        }

        $provider = Auth::guard('provider')->user();
        $order = Order::findOrFail($request->order_id);

        /// Service Cost
        $CarService= CarService::findOrFail($order->car_service_id);
        $distanceFirstWay  = distance($order->from_lat,$order->from_lng,$order->to_lat,$order->to_lng);
        $distanceSecondWay = 0;
        if($CarService->id == 3){
            $distanceSecondWay  = distance($provider->lat,$provider->lng,$order->from_lat,$order->from_lng);
        }

        $totalDistance= $distanceFirstWay+$distanceSecondWay;
        $totalPrice =  $CarService->cost + ($totalDistance * $CarService->distance_cost);

        // accept offer
        $order->status_id = Status::ACCEPTED_STATUS;
        $order->provider_id = $provider->id;
        $order->provider_lat=$provider->lat;
        $order->provider_lng=$provider->lng;
        $order->price = round($totalPrice);
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
                $query->where('status_id', Status::ACCEPTED_STATUS)
                    ->where('provider_id',Auth::guard('provider')->id());
            })]
        ]);
        if (!is_array($validator) && $validator->fails()) {
            return callback_data(error(), $validator->errors()->first());
        }

        $provider = Auth::guard('provider')->user();
        $order = Order::findOrFail($request->order_id);

        // start order
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
        $offerExists = Offer::where('order_id', $request->order_id)
            ->where('provider_id', Auth::guard('provider')->id())
            ->first();
        if ($offerExists) {
            return callback_data(error(), 'offer_sent_before');
        }
        //send reject offer
        Offer::create([
            'order_id' => $request->order_id,
            'provider_id' => Auth::guard('provider')->id(),
            'status_id' => Status::CANCELED_BY_PROVIDER_STATUS,
        ])->refresh();
        return callback_data(success(), 'order_rejected_successfully');
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

}
