<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\CarSerivceResource;
use App\Http\Resources\ReadyServiceResource;
use App\Models\CarService;
use App\Models\Order;
use App\Models\ReadyService;
use App\Models\Service;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CarSerivceController extends Controller
{
    public function index(){
        $data = CarSerivceResource::collection(CarService::active()->orderBy('sort')->with('children')->get());
        return callback_data(success(),'success_response',$data);
    }

    public function createOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'car_service_id' => 'required|exists:car_services,id',
            'to_lat' => 'required',
            'to_lng' => 'required',
            'to_address' => 'required',
        ], [
            'car_service_id.required' => 'car_service_required',
            'car_service_id.exists' => 'car_service_unique',
        ]);
        if (!is_array($validator) && $validator->fails()) {
            return callback_data(error(),$validator->errors()->first());
        }
        $user = Auth::guard('user')->user() ;
        if(empty($user->lat) ||  empty($user->lng) ){
            return callback_data(not_accepted(),'set_location_first');
        }

        Order::create([
            'user_id' => Auth::guard('user')->id(),
            'type' => 'cars',
            'service_id' => Service::where('id',3)->value('id'),
            'car_service_id' => $request->car_service_id,
            'radius' => 15,
            'from_lat' => $user->from_lat,
            'from_lng' => $user->from_lng,
            'from_address' => $user->from_address,
            'to_lat' => $request->to_lat,
            'to_lng' => $request->to_lng,
            'to_address' => $request->to_address,
            'status_id' => Status::PENDING_STATUS,
        ]);

        return callback_data(success(),'success_response');
    }

}
