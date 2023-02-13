<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\Service;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReadyServiceOrderController extends Controller
{

    public function createOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ready_service_id' => 'required|exists:ready_services,id',
            'radius' => 'required|between:1,100',
            'description' => 'required_without:voice|min:10',
            'voice' => 'required_without:description|mimes:application/octet-stream,audio/mpeg,mpga,mp3,wav',
        ], [
            'ready_service_id.required' => 'ready_service_required',
            'ready_service_id.exists' => 'ready_service_unique',
            'radius.required' => 'radius_required',
            'radius.between' => 'radius_between',
            'description.required_without' => 'description_required_without_voice',
            'description.min' => 'description_min_10',
            'voice.required_without' => 'voice_required_without_description',
            'voice.mimes' => 'voice_mimes_mp3',
        ]);
        if (!is_array($validator) && $validator->fails()) {
            return callback_data(error(),$validator->errors()->first());
        }

        Order::create([
            'user_id' => Auth::guard('user')->id(),
            'type' => 'ready',
            'service_id' => Service::where('id',4)->value('id'),
            'ready_service_id' => $request->ready_service_id,
            'radius' => $request->radius,
            'from_lat' => Auth::guard('user')->user()->lat,
            'from_lng' => Auth::guard('user')->user()->lng,
            'description' => $request->description,
            'voice' => $request->voice,
            'status_id' => Status::PENDING_STATUS,
        ]);

        return callback_data(success(),'ready_order_created_successfully');
    }

    public function orders()
    {
        $orders = OrderResource::collection(Order::where('user_id',Auth::guard('user')->id())->orderBy('id','desc')->get());
        return callback_data(success(),'my_orders',$orders);
    }


}
