<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
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

    public function checkPhone(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone'=>'required',
        ],[
            "phone.required" => 'phone_required',
        ]);
        if (!is_array($validator) && $validator->fails()) {
            return callback_data(error(),$validator->errors()->first());
        }

        $otp = otp_code();
        // check if phone is ksa
        $isKsaPhone = Str::startsWith($request->phone, '+966');
        if ($isKsaPhone){
            User::updateOrCreate(['phone' => $request->phone],['phone' => $request->phone, 'otp' => $otp,'password'=>'123456']);
            // $this->sms();
            $curl = curl_init();

            $message=  'Your Otp Code is : '.$otp.' ( Klsh App )';
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'http://REST.GATEWAY.SA/api/SendSMS?api_id=API61856605654&api_password=RiuFeVWosu&sms_type=T&encoding=T&sender_id=Gateway.sa&phonenumber=+966560452395&textmessage=test&uid=xyz&callback_url=https://xyz.com/',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
            ));

            $response = curl_exec($curl);

            curl_close($curl);

            return callback_data(success(),'otp_sent',$otp);
        }else{ // if not ksa phone
            $user = User::where('phone',$request->phone)->first();
            if (!$user){
                return callback_data(complete_register(),'complete_register');
            }else{
                User::updateOrCreate(['phone' => $request->phone],['phone' => $request->phone, 'otp' => $otp,'password'=>'123456']);
                //   Mail::send('mail.register_code_mail', ['otp_code' => $otp], function ($message) use ($user) {
                //      $message->to($user->email);
                //      $message->subject('email verification');
                // });
                return callback_data(code_sent(),'otp_sent_mail',$otp);

            }
        }
    }

    public function EmailOtp(Request $request){

        $validator = Validator::make($request->all(), [
            'phone'=>'required|unique:users,phone',
            'email'=>'required|email|unique:users,phone',
            'name'=>'required',
        ],[
            "phone.required" => 'phone_required',
            "phone.unique" => 'phone_exists_before',
            "email.required" => 'email_required',
            "email.email" => 'email_not_valid',
            "email.unique" => 'email_exists_before',
            "name.required" => 'name_required',
        ]);
        if (!is_array($validator) && $validator->fails()) {
            return callback_data(error(),$validator->errors()->first());
        }
        $otp = otp_code();

        // create user
        User::create([
            'phone' => $request->phone,
            'email' => $request->email,
            'name' => $request->name,
            'device_token' => $request->device_token,
            'otp' => $otp,
            'password'=>123456
        ]);

        // send mail
        //   Mail::send('mail.register_code_mail', ['otp_code' => $otp], function ($message) use ($request){
        //    $message->to($request->email);
        //     $message->subject('email verification');
        // });
        return callback_data(code_sent(),'otp_sent_mail',$otp);

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
            return callback_data(success(),'invalid_otp');
        } elseif (!$jwt_token = Auth('user')->attempt(['email' => $request->email,'password' => 123456])) {
            return callback_data(success(),'invalid_otp');
        } else {
            $user = Auth::guard('user')->user();
            $user->device_token = $request->device_token;
            $user->email_verified_at=\Carbon\Carbon::now();
            $user->otp=null;
            $user->save();

            return callback_data(success(),'login_success', UserResource::make($user)->token($jwt_token));

        }


    }
    public function phoneLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'otp' => 'required',
            'phone' => 'required|regex:/(966)[0-9]{8}/',
            'device_token'=>'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => validation(), 'msg' => $validator->messages()->first(), 'data' => (object)[]], validation());
        }

        $user =  User::where('otp',$request->otp)->where('phone',$request->phone)->first();
        $jwt_token = null;
        if (!isset($user)) {
            return callback_data(error(),'invalid_otp');
        } elseif($user->status  == 'inactive'){
            return callback_data(not_accepted(),'inactive_user');
        } elseif (!$jwt_token = Auth('user')->attempt(['phone' => $request->phone,'password' => '123456','otp'=>$request->otp])) {
            return callback_data(error(),'invalid_otp');

        } else {

            $user = Auth::guard('user')->user();
            $user->device_token = $request->device_token;
            $user->email_verified_at=\Carbon\Carbon::now();
            $user->otp=null;
            $user->save();

            $user->token = $jwt_token;

            return callback_data(success(),'login_success', UserResource::make($user)->token($jwt_token));

        }


    }





    public function profile()
    {
        $user = Auth::guard('user')->user();
        return callback_data(success(),'login_success', UserResource::make($user));
    }


    public function updateProfile(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email'=>'email'
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => validation(), 'msg' => $validator->messages()->first(), 'data' => (object)[]], validation());
        }
        $user = Auth::guard('user')->user();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->save();

        return callback_data(success(),'login_success', UserResource::make($user));

    }
    public function logout(Request $request){

       Auth::guard('user')->logout();

        return callback_data(success(),'logout_success');

    }

}
