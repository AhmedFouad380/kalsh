<?php

namespace App\Http\Controllers\Api\Provider;

use App\Helpers\ResearchProvidersTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Http\Resources\ProviderResource;
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

class DreamServiceOrderController extends Controller
{
    use ResearchProvidersTrait;

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
        $order = Order::findOrFail($request->order_id);
        if (!$order) {
            return callback_data(error(), 'order_not_found');
        }
        // accept offer
        $order->status_id = Status::ACCEPTED_STATUS;
        $order->save();
        // send notification to provider
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

        return callback_data(success(), 'order_accepted_successfully');
    }

    public function rejectOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => ['required', Rule::exists('orders', 'id')->where(function ($query) {
                $query->where('status_id', Status::PENDING_STATUS);
            })],
            'status' => ['required', 'in:reject,unknown']
        ]);
        if (!is_array($validator) && $validator->fails()) {
            return callback_data(error(), $validator->errors()->first());
        }

        $order = Order::findOrFail($request->order_id);

        if (!$order) {
            return callback_data(error(), 'order_not_found');
        }

        if ($request->status == "reject") {
            $order->status_id = Status::REJECTED_BY_PROVIDER_STATUS;
            $title_ar = 'رفض الطلب';
            $title_en = 'order Rejected';
            $msg_ar = 'تم رفض الطلب رقم ' . '#' . $order->id;
            $msg_en = 'You order# ' . $order->id . ' has been rejected ';
            $key = 'order_rejected_successfully';
        } else {
            $order->status_id = Status::UNKNOWN_STATUS;
            //need change msgs
            $title_ar = 'رفض الطلب';
            $title_en = 'order Rejected';
            $msg_ar = 'تم رفض الطلب رقم ' . '#' . $order->id;
            $msg_en = 'You order# ' . $order->id . ' has been rejected ';
            $key = 'order_unknown_successfully';
        }

        $order->save();

        // send notification to user
        $user = $order->user;
        sendToUser([$user->device_token], ${'title_' . $user->lang}, ${'msg_' . $user->lang}, Notification::REJECT_ORDER_TYPE, $order->id, @optional($order)->type);

        Notification::create([
            'type' => Notification::REJECT_ORDER_TYPE,
            'notifiable_type' => User::class,
            'notifiable_id' => $user->id,
            'order_id' => $order->id,
            'title_ar' => $title_ar,
            'title_en' => $title_en,
            'description_ar' => $msg_ar,
            'description_en' => $msg_en,
        ]);

        return callback_data(success(), $key);
    }


    public function completeOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => ['required', Rule::exists('orders', 'id')->where(function ($query) {
                $query->where('status_id', Status::ACCEPTED_STATUS)
                    ->where('payment_status', 'paid');
            })]
        ]);
        if (!is_array($validator) && $validator->fails()) {
            return callback_data(error(), $validator->errors()->first());
        }

        $order = Order::findOrFail($request->order_id);

        if (!$order) {
            return callback_data(error(), 'order_not_found');
        }

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

        return callback_data(success(), 'order_completed_successfully');
    }


}
