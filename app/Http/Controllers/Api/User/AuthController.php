<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use PHPOpenSourceSaver\JWTAuth\JWTAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    public function check_phone(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone'=>'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => validation(), 'msg' => $validator->messages()->first(), 'data' => (object)[]], validation());
        }
        //generate otp
        $otp_code = rand(0000, 9999);


        $exists_ksa = Str::startsWith($request->phone, '+966');

        if ($exists_ksa) {
            if($user=User::where('phone',$request->phone)->first()){
                $user_data['phone'] = $request->phone;
                $user_data['otp'] = $otp_code;
                User::where('phone',$request->phone)->update($user_data);
                $user_data['type']='in';
                if($user->name == null){
                    $user_data['is_complete']=0;
                }else {
                    $user_data['is_complete'] = 1;
                }


            }else{
                $user_data['phone'] = $request->phone;
                $user_data['otp'] = $otp_code;
                $user_data['status'] = 'active';
                $user_data['password'] = Hash::make('123456');
                User::create($user_data);
                $user_data['type']='in';
                $user_data['is_complete']=0;

            }
            //send otp to ksa number by sms...............................
//            $message = 'Your otp code is :' . $otp_code;
//            smsotp::send($data['phone'],$message);
            return callback_data(success(),'check_phones',$user_data);

        } else {

            if($user = User::where('phone',$request->phone)->first() ){
                $user_data['phone'] = $request->phone;
                $user_data['otp'] = null;
                User::where('phone',$request->phone)->first()->update($user_data);
                $user = User::where('phone',$request->phone)->select('id','phone','email')->first();
                $user->type='out';
                if($user->name == null){
                    $user->is_complete=0;
                }else {
                    $user->is_complete=1;
                }


            }else{
                $user_data['phone'] = $request->phone;
                $user_data['otp'] = null;
                User::create($user_data);
                $user = User::where('phone',$request->phone)->select('id','phone','email')->first();
                $user->type='out';
                if($user->name == null){
                    $user->is_complete=0;
                }else {
                    $user->is_complete=1;
                }
            }
            return callback_data(success(),'check_phones',$user);

        }
    }

    public function EmailOtp(Request $request){

        $validator = Validator::make($request->all(), [
            'phone'=>'required',
            'email'=>'required',
            'name'=>'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => validation(), 'msg' => $validator->messages()->first(), 'data' => (object)[]], validation());
        }
        $otp_code = rand(0000, 9999);


        if(isset($request->phone)){

            $user_data['phone'] = $request->phone;
            $user_data['email'] = $request->email;
            $user_data['name'] = $request->name;
            $user_data['password'] = Hash::make(123456);
            $user_data['otp'] = $otp_code;
            $user_data['status'] = 'active';
            User::where('phone',$request->phone)->update($user_data);
            $user_data['type']='out';
            $user_data['is_complete']=2;

            $user_data2['email'] = $request->email;
            $user_data2['otp'] = $otp_code;

            User::where('phone',$request->phone)->first();



            //send mail to not ksa number by email.................................
               Mail::send('mail.register_code_mail', ['otp_code' => $otp_code], function ($message) use ($user_data) {
                   $message->to($user_data['email']);
                  $message->subject('email verification');
               });

            return callback_data(success(),'check_phones',$user_data2);

        }
    }
    public function emailLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'otp' => 'required',
            'email' => 'required',
            'device_token'=>'required'

        ]);
        if ($validator->fails()) {
            return response()->json(['status' => validation(), 'msg' => $validator->messages()->first(), 'data' => (object)[]], validation());
        }

        $count =  User::where('otp',$request->otp)->where('email',$request->email)->count();

        $jwt_token = null;
        if ($count == 0) {
            return callback_data(success(),'invalid_otp', (object)[]);
        } elseif (!$jwt_token = Auth('user')->attempt(['email' => $request->email,'password' => 123456], ['exp' => \Carbon\Carbon::now()->addDays(7)->timestamp])) {
            return callback_data(success(),'invalid_otp', (object)[]);

        } else {

            $user = Auth::guard('user')->user();
            $user->device_token = $request->device_token;
            $user->save();

            $user->token = $jwt_token;

            return callback_data(success(),'login_success', $user);

        }


    }
    public function phone_login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'otp' => 'required',
            'phone' => 'required',
            'device_token'=>'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => validation(), 'msg' => $validator->messages()->first(), 'data' => (object)[]], validation());
        }


        $count =  User::where('otp',$request->otp)->where('phone',$request->phone)->count();
        $jwt_token = null;
        if ($count == 0) {

            return callback_data(success(),'invalid_otp', (object)[]);

        } elseif (!$jwt_token = Auth('user')->attempt(['phone' => $request->phone,'password' => 123456,'otp'=>$request->otp], ['exp' => \Carbon\Carbon::now()->addDays(7)->timestamp])) {

            return callback_data(success(),'invalid_otp', (object)[]);

        } else {

            $user = Auth::guard('user')->user();
            $user->device_token = $request->device_token;
            $user->save();

            $user->token = $jwt_token;
            if($user->name==null){
                $user->is_complete=0;
            }else{
                $user->is_complete=1;

            }
            return callback_data(success(),'login_success', $user);

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
