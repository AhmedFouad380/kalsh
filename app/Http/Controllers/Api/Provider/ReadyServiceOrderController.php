<?php

namespace App\Http\Controllers\Api\Provider;

use App\Http\Controllers\Controller;
use App\Http\Resources\OfferResource;
use App\Http\Resources\OrderResource;
use App\Http\Resources\ServiceResource;
use App\Http\Resources\SliderResource;
use App\Models\Chat;
use App\Models\Offer;
use App\Models\Order;
use App\Models\Service;
use App\Models\Slider;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ReadyServiceOrderController extends Controller
{

    public function pendingOrders()
    {
        $data = OrderResource::collection(Order::where('status_id',Status::PENDING_STATUS)
            ->whereNull('provider_id')
            ->orderBy('created_at', 'desc')
            ->get());
        return callback_data(success(), 'pending_orders', $data);
    }

    public function sendOffer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => ['required',Rule::exists('orders','id')],
            'description' => 'required|string|max:1000',
        ]);
        if (!is_array($validator) && $validator->fails()) {
            return callback_data(error(), $validator->errors()->first());
        }
        //first store reply
        Offer::create([
            'order_id' => $request->order_id
        ]);
        $offer = Offer::findOrFail($request->offer_id);

        //check exists chat first ..
        $exists_chat = Chat::where('user_id', $offer->order->user_id)->where('provider_id', Auth::guard('provider')->id())->where('order_id', $offer->order_id)->first();
        if (!$exists_chat) {
            $offer->description = $request->description;
            if ($offer->save()) {
                //second start chat with user
                Chat::create([
                    'user_id' => $offer->order->user_id,
                    'provider_id' => Auth::guard('provider')->id(),
                    'order_id' => $offer->order_id,
                    'offer_id' => $request->offer_id,
                ]);
                //create two default messages (one for order content , second for offer description)
//                ...
            }
        } else {
            return callback_data(error(), 'offer_send_before');
        }


        return callback_data(success(), 'offer_send_to_user_successfully');


    }


}
