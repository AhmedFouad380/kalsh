<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\VerifyOtpRequest;
use App\Http\Requests\User\CheckPhoneRequest;
use App\Http\Requests\User\RegistrationNotKSASendCodeRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use PHPOpenSourceSaver\JWTAuth\JWTAuth;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function check_phone(CheckPhoneRequest $request)
    {
        $data = $request->validated();

        //generate otp
        if (config('app.env') == 'local') {
            $otp_code = 1234;
        } else {
            $otp_code = rand(0000, 9999);
        }

        $exists_ksa = Str::startsWith($data['phone'], '+966');
        if ($exists_ksa) {
            $user_data['phone'] = $request->phone;
            $user_data['otp'] = $otp_code;
            User::create($user_data);
            //send otp to ksa number by sms...............................
//            $message = 'Your otp code is :' . $otp_code;
//            smsotp::send($data['phone'],$message);
            return msg(true, trans('lang.phone_in_ksa'), 203);
        } else {
            $exists_phone = User::where('email_verified_at', '!=', null)->where('phone', $data['phone'])->first();
            if ($exists_phone) {
                $exists_phone->otp = $otp_code;
                $exists_phone->save();
                //send mail to not ksa number by email.................................
//                Mail::send('mail.register_code_mail', ['otp_code' => $otp_code], function ($message) use ($data) {
//                    $message->to($data['email']);
//                    $message->subject('email verification');
//                });
                return msg(true, trans('lang.phone_exists_login_now'), 203);
            } else {
//                check if user exists before or not
                $unverified_user = User::where('phone', $data['phone'])->first();
                if ($unverified_user) {
                    return msgdata(true, trans('lang.phone_not_exists_register_now'), $unverified_user, 405);
                } else {
                    return msg(true, trans('lang.phone_not_exists_register_now'), not_found());
                }
            }
        }
    }

    public function register(RegistrationNotKSASendCodeRequest $request)
    {
        $data = $request->validated();
        //send email to user to make register
        if (config('app.env') == 'local') {
            $otp_code = 1234;
        } else {
            $otp_code = rand(0000, 9999);
//            $otp_code = \Otp::generate($data['email']);
        }
//        Mail::send('mail.register_code_mail', ['otp_code' => $otp_code], function ($message) use ($data) {
//            $message->to($data['email']);
//            $message->subject('email verification');
//        });
        $data['otp'] = $otp_code;
        User::create($data);
        return msg(true, trans('lang.code_send_to_email'), 203);
    }

    public function verifyOtp(VerifyOtpRequest $request)
    {
        $data = $request->validated();
        $data['location'] = 'out_ksa';

        //send email to user to make register
        if (config('app.env') == 'production') {
//            $otp_code = rand(0000, 9999);
            $validated = \Otp::validate($data['email'], $data['otp']);
            if (!$validated) {
                return msg(false, trans('lang.otp_invalid'), error());
            }
        }
        $select_user = User::where('otp', $data['otp'])->first();
        if ($select_user) {
//            $select_user->email_verified_at = Carbon::now();
//            $select_user->otp = null;
//            $select_user->save();

            //make login
            if (!$token = JWTAuth::fromUser($select_user)) {
                return msg(false, trans('lang.unauthorized'), error());
            }
            $result['token'] = $token;
            $result['user_data'] = Auth::guard('user')->user();
            return msgdata(true, trans('lang.login_s'), $result, success());
        } else {
            return msg(false, trans('lang.otp_invalid'), error());
        }
    }

    public function profile()
    {
        $user = Auth::guard('user')->user();
        return msgdata(true, trans('lang.data_display_success'), $user, success());
    }

}
