<?php

namespace App\Http\Controllers\Api\Provider;

use App\Http\Controllers\Controller;
use App\Http\Resources\OfferResource;
use App\Http\Resources\OrderResource;
use App\Http\Resources\ServiceResource;
use App\Http\Resources\SliderResource;
use App\Models\Chat;
use App\Models\Message;
use App\Models\Notification;
use App\Models\Offer;
use App\Models\Order;
use App\Models\Provider;
use App\Models\ProviderReadyService;
use App\Models\ProviderService;
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
    // home page for provider app
    public function pendingOrders()
        {
            //should get orders by service_id and ready_service_id
            $provider = Auth::guard('provider')->user();
            $service_ids = ProviderService::where('provider_id',$provider->id)->pluck('service_id')->toArray();
            $ready_service_ids = ProviderReadyService::where('provider_id',$provider->id)->pluck('ready_service_id')->toArray();

            // get orders
            $orders = Order::where(function ($query) use($provider){
                $query->where(function ($query2){ // get pending order
                    $query2->whereNull('provider_id')
                        ->where('status_id', Status::PENDING_STATUS);
                })
                    ->orWhere(function ($query3) use($provider){ // get accepted orders for auth provider
                        $query3->where('provider_id',$provider->id)
                            ->whereIn('status_id', [Status::PENDING_STATUS,Status::ACCEPTED_STATUS])
                        ;
                    });
            })
                ->whereIn('service_id', $service_ids)
                ->where(function ($query) use($ready_service_ids){
                    $query->whereHas('readyService',function ($query2) use($ready_service_ids){
                        $query2->whereIn('ready_service_id', $ready_service_ids);
                    })
                        ->orWhereDoesntHave('readyService');
                })
                ->whereHas('notifications',function ($query) use($provider){
                    $query->where('type',Notification::NEW_ORDER_TYPE)
                        ->where('notifiable_type',Provider::class)
                        ->where('notifiable_id',$provider->id);
                })
                ->WhereDoesntHave('rejectedOrder')  //for remove orders that provider reject it
                ->orderBy('id', 'desc')
                ->get();

            $data = OrderResource::collection($orders);
            return callback_data(success(), 'pending_orders', $data);
        }

    public function sendOffer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => ['required', Rule::exists('orders', 'id')->where(function ($query) {
                $query->where('status_id', Status::PENDING_STATUS);
            })],
            'description' => 'required|string|max:1000',
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
        if (!$chat->messages()->exists()) {
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
        // get accepted offer
        $offer = Offer::where('order_id', $order->id)
            ->where('provider_id', $provider->id)
            ->where('status_id', Status::ACCEPTED_STATUS)
            ->first();

        if (!$offer) {
            return callback_data(error(), 'offer_not_found');
        }

        // accept offer
        $order->status_id = Status::ACCEPTED_STATUS;
        $order->provider_id = $provider->id;
        $order->save();

        // send notification to user
        $user = $order->user;

        $title_ar = '???????? ??????????';
        $title_en = 'Order Accept';
        $msg_ar = "???? ???????? ???????? ?????? #{$order->id}" . "???????????? ???????? ???????????? {$provider->name}";
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
            'status_id' => Status::REJECTED_BY_PROVIDER_STATUS,
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

        $title_ar = '?????????? ??????????';
        $title_en = 'Order Completed';
        $msg_ar = "???? ???????????? ?????????? ?????? #{$order->id}" . "???????????? ???????? ???????????? {$provider->name}";
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

    public function orders()
    {
        $orders = OrderResource::collection(Order::where('provider_id',Auth::guard('provider')->id())
            ->whereIn('status_id',[Status::CANCELED_BY_USER_STATUS,Status::COMPLETED_STATUS])
            ->orderBy('id','desc')
            ->get());
        return callback_data(success(),'my_orders',$orders);
    }
}
