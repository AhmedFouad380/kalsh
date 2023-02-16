<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProviderResource;
use App\Http\Resources\ReadyServiceResource;
use App\Http\Resources\ServiceResource;
use App\Http\Resources\SliderResource;
use App\Http\Resources\UserResource;
use App\Models\ReadyService;
use App\Models\Service;
use App\Models\Slider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index()
    {
        $data['slider'] = SliderResource::make(Slider::where('type',Slider::HOME_TYPE)->active()->first());
        $data['services'] = ServiceResource::collection(Service::active()->orderBy('sort')->get());
        return callback_data(success(),'home',$data);
    }

    public function updateLocation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'lat'=>'required',
            'lng'=>'required',
        ]);
        if (!is_array($validator) && $validator->fails()) {
            return response()->json(['status' => error(),'msg' => $validator->errors()->first()]);
        }
        $user = Auth::guard('user')->user();
        $user->lat = $request->lat;
        $user->lng = $request->lng;
        $user->save();
        return callback_data(success(),'save_success',UserResource::make($user));

    }

    public function updateLanguage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'lang'=>'required|in:ar,en',
        ]);
        if (!is_array($validator) && $validator->fails()) {
            return response()->json(['status' => error(),'msg' => $validator->errors()->first()]);
        }
        $user = Auth::guard('user')->user();
        $user->lang = $request->lang;
        $user->save();
        return callback_data(success(),'save_success', UserResource::make($user));
    }


}
