<?php

namespace App\Http\Controllers\Api\Provider;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReadyServiceResource;
use App\Http\Resources\ServiceResource;
use App\Models\Provider;
use App\Models\ReadyService;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{

    public function updateLocation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'lat'=>'required',
            'lng'=>'required',
        ]);
        if (!is_array($validator) && $validator->fails()) {
            return response()->json(['status' => error(),'msg' => $validator->errors()->first()]);
        }

        $provider = Auth::guard('provider')->user();
        $provider->lat = $request->lat;
        $provider->lng = $request->lng;
        $provider->save();
        return callback_data(success(),'save_success', $provider);
    }

    public function updateLanguage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'lang'=>'required|in:ar,en',
        ]);
        if (!is_array($validator) && $validator->fails()) {
            return callback_data(error(),$validator->errors()->first());
        }
        $provider = Auth::guard('provider')->user();
        $provider->lang = $request->lang;
        $provider->save();
        return callback_data(success(),'save_success', $provider);
    }

    public function Services(Request $request){
            $data = ServiceResource::collection(Service::where('is_provider','!=',0)->active()->orderBy('sort')->get());
            return callback_data(success(),'success_response',$data);
    }
    public function ReadyService()
    {
        $readyServices = ReadyServiceResource::collection(ReadyService::active()->orderBy('sort')->get());
        return callback_data(success(),'readyServices',$readyServices);
    }
}
