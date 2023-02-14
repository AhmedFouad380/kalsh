<?php

namespace App\Http\Controllers\Api\Provider;

use App\Http\Controllers\Controller;
use App\Http\Resources\OfferResource;
use App\Http\Resources\OrderResource;
use App\Http\Resources\ServiceResource;
use App\Http\Resources\SliderResource;
use App\Models\Chat;
use App\Models\Message;
use App\Models\Offer;
use App\Models\Order;
use App\Models\Provider;
use App\Models\Rate;
use App\Models\Service;
use App\Models\Slider;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ReadyServiceOrderController extends Controller
{

    public function pendingOrders()
    {
        $data = OrderResource::collection(Order::where('status_id', Status::PENDING_STATUS)
            ->whereNull('provider_id')
            ->orderBy('created_at', 'desc')
            ->get());
        return callback_data(success(), 'pending_orders', $data);
    }

    public function sendOffer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => ['required',Rule::exists('orders','id')->where(function($query){
                $query->where('status_id',Status::PENDING_STATUS);
            })],
            'description' => 'required|string|max:1000',
        ]);
        if (!is_array($validator) && $validator->fails()) {
            return callback_data(error(), $validator->errors()->first());
        }
        // check if offer sent before
        $offerExists = Offer::where('order_id', $request->order_id)
            ->where('provider_id',Auth::guard('provider')->id())
            ->first();
        if ($offerExists){
            return callback_data(error(), 'offer_sent_before');
        }

        //send offer
        $offer = Offer::create([
            'order_id' => $request->order_id,
            'provider_id' => Auth::guard('provider')->id(),
            'status_id' => Status::PENDING_STATUS,
            'description' => $request->description
        ])->refresh();

        $order = Order::findOrFail($request->order_id);

        // create chat
        $chat = Chat::firstOrCreate([
            'order_id' => $order->id,
            'user_id' => $order->user_id,
            'provider_id' => Auth::guard('provider')->id(),
            'offer_id' => $offer->id,
        ], [
            'order_id' => $order->id,
            'user_id' => $order->user_id,
            'provider_id' => Auth::guard('provider')->id(),
            'offer_id' => $offer->id,
            'type' => 'from_user'
        ]);

        // create messages if not exists
        if (!$chat->messages()->exists()){
            // 1- order description
            Message::create([
                'chat_id' => $chat->id,
                'sender_type' => User::class,
                'sender_id' => $order->user_id,
                'message' => $order->description,
                'voice' => $order->voice,
            ]);

            // 1- offer description
            Message::create([
                'chat_id' => $chat->id,
                'sender_type' => Provider::class,
                'sender_id' => Auth::guard('provider')->id(),
                'message' => $offer->description,
            ]);
        }
        return callback_data(success(), 'offer_sent_successfully');
    }


    public function rateUser(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'order_id' => 'required|exists:orders,id,provider_id,' . Auth::guard('provider')->id(),
            'comment' => 'required|string|max:1000',
            'rate' => 'required|integer|between:1,5',
        ]);
        if (!is_array($validator) && $validator->fails()) {
            return callback_data(error(), $validator->errors()->first());
        }
        //first check if rated before or not
        $exists_rate = Rate::where('provider_id', Auth::guard('provider')->id())->where('order_id', $request->order_id)->first();
        if (!$exists_rate) {
            $order = Order::where('id', $request->order_id)->first();
            if ($order->status_id != Status::COMPLETED_STATUS) {
                return callback_data(error(), 'order_must_complete_first');
            }
            $data['user_id'] = $order->user_id;
            $data['provider_id'] = Auth::guard('provider')->id();
            $data['type'] = 'from_provider';
            Rate::create($data);
            //update order make provider rate = 1
            $order->provider_rated = 1;
            $order->save();
            return callback_data(success(), 'rate_send_to_user_successfully');
        } else {
            return callback_data(error(), 'rate_send_before');
        }
    }
}
