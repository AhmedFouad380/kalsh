<?php

namespace App\Http\Controllers\Api\Provider;

use App\Http\Controllers\Controller;
use App\Http\Requests\Provider\providerLoginRequest;
use App\Http\Requests\Provider\ProviderRegistrationRequest;
use App\Models\Provider;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function login(providerLoginRequest $request)
    {
        $request->validated();
        $credentials = $request->only('email', 'password');
        $token = Auth::guard('provider')->attempt($credentials);
        if (!$token) {
            return msg(false, trans('lang.unauthorized'), failed());
        }
        $result['token'] = $token;
        $result['provider_data'] = Auth::guard('provider')->user();
        return msgdata(true, trans('lang.login_s'), $result, success());
    }

    public function register(ProviderRegistrationRequest $request)
    {
        $data = $request->validated();
        Provider::create($data);
        return msg(true, trans('lang.sign_up_success'), success());
    }

    public function profile()
    {
        $client = Auth::guard('provider')->user();
        return msgdata(true, trans('lang.data_display_success'), $client, success());
    }

}
