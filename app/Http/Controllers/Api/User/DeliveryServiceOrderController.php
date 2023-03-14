<?php

namespace App\Http\Controllers\Api\User;

use App\Helpers\ResearchProvidersTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\CarSerivceResource;
use App\Http\Resources\DeliverySerivceResource;
use App\Http\Resources\OrderResource;
use App\Http\Resources\ProviderResource;
use App\Models\CarService;
use App\Models\Chat;
use App\Models\DeliveryService;
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

class DeliveryServiceOrderController extends Controller
{
    use ResearchProvidersTrait;


    public function deliveryServices(){
        $data = DeliverySerivceResource::collection(DeliveryService::active()->get());
        return callback_data(success(),'success_response',$data);
    }

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
            'delivery_service_id' => 'required|exists:delivery_services,id',
            'from_lat' => 'required_if:delivery_service_id,2',
            'from_lng' => 'required_if:delivery_service_id,2',
            'from_address' => 'required_if:delivery_service_id,2',
            'to_lat' => 'required',
            'to_lng' => 'required',
            'to_address' => 'required',
            'description' => 'required_without:voice',
            'voice' => 'required_without:description',

        ]);
        if (!is_array($validator) && $validator->fails()) {
            return callback_data(error(), $validator->errors()->first());
        }
        $service = DeliveryService::find($request->delivery_service_id);


        if($service->type == 'delivery'){
            $type = 'delivery';
            $user = Auth::guard('user')->user();
            if (empty($user->lat) || empty($user->lng)) {
                return callback_data(not_accepted(), 'set_location_first');
            }
            $distance =  distance($user->lat,$user->lng,$request->to_lat,$request->to_lng);
            if($distance > $service->min_distance){
                $overdistance = $distance - $service->min_distance;
                $overCost = $service->kilo_cost * round($overdistance,2);
                $price = $service->min_cost + $overCost;
            }else{
                $price=$service->min_cost;
            }
            $data=  Order::create([
                'user_id' => Auth::guard('user')->id(),
                'type' => $type,
                'service_id' => 1,  // dream service
                'radius' => $service->range_shop,
                'range_provider' => $service->range_provider,
                'range_provider_to_shop' => $service->range_provider_to_shop,
                'from_lat' => $user->lat,
                'from_lng' => $user->lng,
                'from_address' => $request->from_address,
                'to_lat' => $request->to_lat,
                'to_lng' => $request->to_lng,
                'to_address' => $request->to_address,
                'description' => $request->description,
                'voice' => $request->voice,
                'price'=>$price,
                'status_id' => Status::PENDING_STATUS,
            ]);


        }elseif($service->type == 'package'){
            $distance =  distance($request->from_lat,$request->from_lng,$request->to_lat,$request->to_lng);
            if($distance > $service->min_distance){
                $overdistance = $distance - $service->min_distance;
                $overCost = $service->kilo_cost * round($overdistance,2);
                $price = $service->min_cost + $overCost;
            }else{
                $price=$service->min_cost;
            }
            $type = 'package_delivery';
          $data =  Order::create([
                'user_id' => Auth::guard('user')->id(),
                'type' => $type,
                'service_id' => 1,  // delivery service
                'radius' => $service->range_shop,
                'range_provider' => $service->range_provider,
                'range_provider_to_shop' => $service->range_provider_to_shop,
                'from_lat' => $request->from_lat,
                'from_lng' => $request->from_lng,
                 'from_address' => $request->from_address,
                'to_lat' => $request->to_lat,
                'to_lng' => $request->to_lng,
                'to_address' => $request->to_address,
                'description' => $request->description,
                'voice' => $request->voice,
                'price' => $price,
                'status_id' => Status::PENDING_STATUS,
            ]);
        }

        return callback_data(success(), 'delivery_order_created_successfully',OrderResource::make($data));
    }
    public function checkCost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'delivery_service_id' => 'required|exists:delivery_services,id',
            'from_lat' => 'required_if:delivery_service_id,2',
            'from_lng' => 'required_if:delivery_service_id,2',
            'from_address' => 'required_if:delivery_service_id,2',
            'to_lat' => 'required',
            'to_lng' => 'required',
            'to_address' => 'required',

        ]);
        if (!is_array($validator) && $validator->fails()) {
            return callback_data(error(), $validator->errors()->first());
        }
        $service = DeliveryService::find($request->delivery_service_id);


        if($service->type == 'delivery'){
            $type = 'delivery';
            $user = Auth::guard('user')->user();
            if (empty($user->lat) || empty($user->lng)) {
                return callback_data(not_accepted(), 'set_location_first');
            }
            $distance =  distance($user->lat,$user->lng,$request->to_lat,$request->to_lng);
            if($distance > $service->min_distance){
                $overdistance = $distance - $service->min_distance;
                $overCost = $service->kilo_cost * round($overdistance,2);
                $price = $service->min_cost + $overCost;
            }else{
                $price=$service->min_cost;
            }



        }elseif($service->type == 'package'){
            $distance =  distance($request->from_lat,$request->from_lng,$request->to_lat,$request->to_lng);
            if($distance > $service->min_distance){
                $overdistance = $distance - $service->min_distance;
                $overCost = $service->kilo_cost * round($overdistance,2);
                $price = $service->min_cost + $overCost;
            }else{
                $price=$service->min_cost;
            }
            $type = 'package_delivery';

        }
        $array = array('price'=>(int) round($price));
        return callback_data(success(), 'success',$array);
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


//        // create chat
//        $chat = Chat::firstOrCreate([
//            'order_id' => $order->id,
//            'user_id' => $order->user_id,
//            'provider_id' => $order->provider_id,
//
//        ], [
//            'order_id' => $order->id,
//            'user_id' => $order->user_id,
//            'provider_id' => $order->provider_id,
//            'type' => 'from_user'
//        ]);

        // create messages if not exists
//        if (!$chat->messages()->exists()) {
//            // 1- order description
//            Message::create([
//                'chat_id' => $chat->id,
//                'sender_type' => User::class,
//                'sender_id' => $order->user_id,
//                'message' => $order->description,
//                'voice' => $order->voice,
//            ]);
//
//        }

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

    public function whoPay(Request $request){
        $data = $request->all();
        $validator = Validator::make($data, [
            'order_id' => 'required|exists:orders,id,user_id,' . Auth::guard('user')->id(),
            'who_pay' => 'required|in:sender,receiver',
        ]);
        if (!is_array($validator) && $validator->fails()) {
            return callback_data(error(), $validator->errors()->first());
        }

        Order::where('id',$request->order_id)->update(['who_pay'=>$request->who_pay]);
        return callback_data(success(), 'save_success');

    }



}
