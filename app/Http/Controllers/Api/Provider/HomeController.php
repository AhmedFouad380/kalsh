<?php

namespace App\Http\Controllers\Api\Provider;

use App\Http\Controllers\Controller;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{

    public function updateLocation(Request $request)
    {
        $provider = Auth::guard('provider')->user();
        $provider->lat = $request->lat;
        $provider->lng = $request->lng;
        $provider->save();
        return callback_data(success(),'save_success', $provider);
    }

    public function setLanguage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'lang'=>'required|in:ar,en',
        ]);
        if (!is_array($validator) && $validator->fails()) {
            return callback_data(error(),$validator->errors()->first());
        }
        $provider = Auth::guard('provider')->user();
        $user->lang = $request->lang;
        $user->save();
        return callback_data(success(),'save_success', $user);
    }
}
