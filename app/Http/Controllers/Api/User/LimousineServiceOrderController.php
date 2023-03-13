<?php

namespace App\Http\Controllers\Api\User;

use App\Helpers\ResearchProvidersTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\CarTypeResource;
use App\Http\Resources\PaymentCardResource;
use App\Http\Resources\ProviderResource;
use App\Models\CarType;
use App\Models\CarTypePrice;
use App\Models\Chat;
use App\Models\Message;
use App\Models\Order;
use App\Models\PaymentCard;
use App\Models\Status;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class LimousineServiceOrderController extends Controller
{
    use ResearchProvidersTrait;

    public function getCarTypes($distance)
    {
        $validator = Validator::make(['distance' => $distance], [
            'distance' => 'required|integer',
        ]);
        if (!is_array($validator) && $validator->fails()) {
            return callback_data(error(), $validator->errors()->first());
        }

        $car_types = CarType::Active()->get();
        foreach ($car_types as $key => $car_type) {
            $total = $car_type->start_price;
            $row = CarTypePrice::where('car_type_id', $car_type->id)
                ->where('from', '<=', $distance)
                ->where('to', '>=', $distance)
                ->first();
            if ($row) {
                $total += $row->price_per_km * $distance;
            }
            $car_type['total'] = $total;

        }
        $data = CarTypeResource::collection($car_types);
        return callback_data(success(), 'success_response', $data);
    }

    public function getNearestProviders(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'lat' => 'required',
            'lng' => 'required',
            'car_type_id' => 'required|exists:car_types,id',
        ]);
        if (!is_array($validator) && $validator->fails()) {
            return callback_data(error(), $validator->errors()->first());
        }
        // get providers in radius
        $providers = $this->nearestProviders($request->lat, $request->lng, nearest_radius(), null, "limousine");
        return callback_data(success(), 'nearest_providers', ProviderResource::collection($providers));
    }

    public function storePaymentCard(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'placeholder_name' => 'required',
            'card_number' => 'required|unique:payment_cards',
            'expired_month' => 'required|digits:2|date_format:m',
            'expired_year' => 'required|digits:2|date_format:y|gte:' . date('y'),
        ]);
        if (!is_array($validator) && $validator->fails()) {
            return callback_data(error(), $validator->errors()->first());
        }
        PaymentCard::create([
            'user_id' => Auth::guard('user')->id(),
            'placeholder_name' => $request->placeholder_name,
            'card_number' => $request->card_number,
            'expired_month' => $request->expired_month,
            'expired_year' => $request->expired_year,
        ]);
        return callback_data(success(), 'save_success');
    }

    public function getPaymentCards()
    {
        $cards = PaymentCard::where('user_id', Auth::guard('user')->id())->active()->get();
        return callback_data(success(), 'payment_cards', PaymentCardResource::collection($cards));
    }


    public function createOrder(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'car_type_id' => 'required|exists:car_types,id',
            'from_lat' => 'required',
            'from_lng' => 'required',
            'to_lat' => 'required',
            'to_lng' => 'required',
            'distance' => 'required|numeric',
            'payment_type' => 'required|in:visa,cash,wallet',
            'payment_card_id' => ['required_if:payment_type,visa', 'exists:payment_cards,id'],

        ]);
        if (!is_array($validator) && $validator->fails()) {
            return callback_data(error(), $validator->errors()->first());
        }
        $user = Auth::guard('user')->user();
        $price = $this->carTypeTotalPrice($request->car_type_id, $request->distance);


        Order::create([
            'user_id' => $user->id,
            'type' => 'limousine',
            'service_id' => 2,
            'car_type_id' => $request->car_type_id,
            'distance' => $request->distance,
            'radius' => limousine_first_radius(),
            'from_lat' => $request->from_lat,
            'from_lng' => $request->from_lng,
            'to_lat' => $request->to_lat,
            'to_lng' => $request->to_lng,
            'payment_type' => $request->payment_type,
            'payment_card_id' => $request->payment_card_id,
            'status_id' => Status::PENDING_STATUS,
            'price' => $price,
        ]);

        return callback_data(success(), 'order_created_successfully');
    }

    public function resendOrder($order_id)
    {
        $order = Order::whereId($order_id)
            ->where('status_id', Status::PENDING_STATUS)
            ->where('user_id', Auth::guard('user')->id())
            ->where('service_id', 2)
            ->whereNull('provider_id')
            ->first();
        if ($order) {
            $radius = $order->radius;

            if ($radius == 10) {
                // i didn`t call $this->cancelOrder to make status canceled by system not by user
                $order->status_id = Status::CANCELED_BY_SYSTEM_STATUS;
                $order->save();
                return callback_data(error(), 'order_canceled');
            }
            $radius = $radius + 3 < 10 ? $radius + 3 : 10;
            //update order radius
            $order->radius = $radius;
            $order->save();
            //search for provider in new radius
            $this->LimousineServiceProviders($order);
            return callback_data(success(), 'searching_for_providers');
        } else {
            return callback_data(error(), 'order_not_found');
        }
    }

    public function cancelOrder($order_id)
    {
        $order = Order::whereId($order_id)
            ->where('status_id', Status::PENDING_STATUS)
            ->where('user_id', Auth::guard('user')->id())
            ->where('service_id', 2)
            ->whereNull('provider_id')
            ->first();

        $order->status_id = Status::CANCELED_BY_USER_STATUS;
        $order->save();

        return callback_data(success(), 'order_cancelled_successfully');
    }

    public function payOrder($order_id)
    {

        $order = Order::whereId($order_id)
            ->where('status_id', Status::ACCEPTED_STATUS)
            ->where('user_id', Auth::guard('user')->id())
            ->where('service_id', 2)
            ->first();
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


}
