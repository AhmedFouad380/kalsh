<?php

namespace App\Http\Controllers\Api\User;

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

class DreamServiceOrderController extends Controller
{
    use ResearchProvidersTrait;

    public function getNearestProviders()
    {
        $user = Auth::guard('user')->user();
        if (empty($user->lat) || empty($user->lng)) {
            return callback_data(not_accepted(), 'set_location_first');
        }
        // get providers in radius
        $providers = $this->nearestProviders($user->lat, $user->lng, nearest_radius());
        return callback_data(success(), 'nearest_providers', ProviderResource::collection($providers));
    }

    public function createOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'provider_id' => 'required|exists:providers,id',
            'description' => 'required_without:voice|min:10',
            'voice' => 'required_without:description|mimes:application/octet-stream,audio/mpeg,mpga,mp3,wav',
        ], [
            'provider_id.required' => 'provider_id_required',
            'provider_id.exists' => 'provider_id_unique',
            'description.required_without' => 'description_required_without_voice',
            'description.min' => 'description_min_10',
            'voice.required_without' => 'voice_required_without_description',
            'voice.mimes' => 'voice_mimes_mp3',
        ]);
        if (!is_array($validator) && $validator->fails()) {
            return callback_data(error(), $validator->errors()->first());
        }
        $user = Auth::guard('user')->user();
        if (empty($user->lat) || empty($user->lng)) {
            return callback_data(not_accepted(), 'set_location_first');
        }

        Order::create([
            'user_id' => Auth::guard('user')->id(),
            'provider_id' => $request->provider_id,
            'type' => 'dream',
            'service_id' => 5,  // dream service
            'radius' => nearest_radius(),
            'from_lat' => $user->lat,
            'from_lng' => $user->lng,
            'description' => $request->description,
            'voice' => $request->voice,
            'status_id' => Status::PENDING_STATUS,
        ]);
        return callback_data(success(), 'dream_order_created_successfully');
    }

    public function acceptOffer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'offer_id' => ['required', Rule::exists('offers', 'id')->where(function ($query) {
                $query->where('status_id', Status::PENDING_STATUS);
            })]
        ]);
        if (!is_array($validator) && $validator->fails()) {
            return callback_data(error(), $validator->errors()->first());
        }

        $offer = Offer::findOrFail($request->offer_id);
        $order = Order::where('id', $offer->order_id)->where('user_id', Auth::guard('user')->id())->first();
        if (!$order) {
            return callback_data(error(), 'order_not_found');
        }

        // accept offer
        $offer->status_id = Status::ACCEPTED_STATUS;
        $offer->save();

        // send notification to provider
        $provider = $offer->provider;

        $title_ar = 'قبول عرض';
        $title_en = 'Offer Accept';
        $msg_ar = 'تم قبول عرضك المقدم علي طلب رقم ' . '#' . $offer->order_id;
        $msg_en = 'You offer has been accepted for order #' . $offer->order_id;
        sendToProvider([$provider->device_token], ${'title_' . $provider->lang}, ${'msg_' . $provider->lang}, Notification::ACCEPT_OFFER_TYPE, $offer->order_id, @optional($offer->order)->type);

        Notification::create([
            'type' => Notification::ACCEPT_OFFER_TYPE,
            'notifiable_type' => Provider::class,
            'notifiable_id' => $provider->id,
            'order_id' => $offer->order_id,
            'offer_id' => $offer->id,
            'title_ar' => $title_ar,
            'title_en' => $title_en,
            'description_ar' => $msg_ar,
            'description_en' => $msg_en,
        ]);

        // reject other offers
        Offer::where('id', '!=', $offer->id)->where('order_id', $offer->order_id)
            ->where('status_id', Status::PENDING_STATUS)
            ->update([
                'status_id' => Status::CANCELED_BY_USER_STATUS
            ]);

        return callback_data(success(), 'offer_accepted_successfully');
    }

    public function rejectOffer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'offer_id' => ['required', Rule::exists('offers', 'id')->where(function ($query) {
                $query->where('status_id', Status::PENDING_STATUS);
            })]
        ]);
        if (!is_array($validator) && $validator->fails()) {
            return callback_data(error(), $validator->errors()->first());
        }

        $offer = Offer::findOrFail($request->offer_id);
        $order = Order::where('id', $offer->order_id)->where('user_id', Auth::guard('user')->id())->first();
        if (!$order) {
            return callback_data(error(), 'order_not_found');
        }

        // cancel offer
        $offer->status_id = Status::REJECTED_BY_USER_STATUS;
        $offer->save();

        // send notification to provider
        $provider = $offer->provider;

        $title_ar = 'رفض عرض';
        $title_en = 'Offer Rejected';
        $msg_ar = 'تم رفض عرضك المقدم علي طلب رقم ' . '#' . $offer->order_id;
        $msg_en = 'You offer has been rejected for order #' . $offer->order_id;
        sendToProvider([$provider->device_token], ${'title_' . $provider->lang}, ${'msg_' . $provider->lang}, Notification::REJECT_ORDER_TYPE, $offer->order_id, @optional($offer->order)->type);

        Notification::create([
            'type' => Notification::REJECT_ORDER_TYPE,
            'notifiable_type' => Provider::class,
            'notifiable_id' => $provider->id,
            'order_id' => $offer->order_id,
            'offer_id' => $offer->id,
            'title_ar' => $title_ar,
            'title_en' => $title_en,
            'description_ar' => $msg_ar,
            'description_en' => $msg_en,
        ]);

        return callback_data(success(), 'offer_rejected_successfully');
    }

    public function cancelOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => ['required', Rule::exists('orders', 'id')->where(function ($query) {
                $query->where('status_id', Status::PENDING_STATUS);
            })]
        ]);
        if (!is_array($validator) && $validator->fails()) {
            return callback_data(error(), $validator->errors()->first());
        }

        $order = Order::where('id', $request->order_id)->where('user_id', Auth::guard('user')->id())->first();
        if (!$order) {
            return callback_data(error(), 'order_not_found');
        }

        // cancel order
        $order->status_id = Status::CANCELED_BY_USER_STATUS;
        $order->save();

        // cancel offers if exists
        Offer::where('order_id', $order->id)
            ->update([
                'status_id' => Status::CANCELED_BY_USER_STATUS
            ]);

        return callback_data(success(), 'order_rejected_successfully');
    }


    public function payOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => ['required', Rule::exists('orders', 'id')->where(function ($query) {
                $query->where('status_id', Status::ACCEPTED_STATUS);
            })]
        ]);
        if (!is_array($validator) && $validator->fails()) {
            return callback_data(error(), $validator->errors()->first());
        }

        $order = Order::where('id', $request->order_id)->where('user_id', Auth::guard('user')->id())->first();
        if (!$order) {
            return callback_data(error(), 'order_not_found');
        }

        // cancel order
        $order->payment_status = Order::PAYMENT_STATUS[1];
        $order->save();


        // create chat
        $chat = Chat::firstOrCreate([
            'order_id' => $order->id,
            'user_id' => $order->user_id,
            'provider_id' => $order->provider_id,

        ], [
            'order_id' => $order->id,
            'user_id' => $order->user_id,
            'provider_id' => $order->provider_id,
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


        return callback_data(success(), 'order_paid_successfully');
    }


    public function rateProvider(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'order_id' => 'required|exists:orders,id,user_id,' . Auth::guard('user')->id(),
            'comment' => 'required|string|max:1000',
            'rate' => 'required|integer|between:1,5',
        ]);
        if (!is_array($validator) && $validator->fails()) {
            return callback_data(error(), $validator->errors()->first());
        }
        //first check if rated before or not
        $exists_rate = Rate::where('user_id', Auth::guard('user')->id())->where('order_id', $request->order_id)->first();
        if (!$exists_rate) {
            $order = Order::where('id', $request->order_id)->first();
            if ($order->status_id != Status::COMPLETED_STATUS) {
                return callback_data(error(), 'order_must_complete_first');
            }
            $data['provider_id'] = $order->provider_id;
            $data['user_id'] = Auth::guard('user')->id();
            $data['type'] = 'from_user';
            Rate::create($data);
            //update order make user rate = 1
            $order->user_rated = 1;
            $order->save();
            return callback_data(success(), 'rate_send_to_user_successfully');
        } else {
            return callback_data(error(), 'rate_send_before');
        }
    }

    public function orders()
    {
        $orders = OrderResource::collection(Order::where('user_id', Auth::guard('user')->id())
            ->orderBy('id', 'desc')->get());
        return callback_data(success(), 'my_orders', $orders);
    }


}
