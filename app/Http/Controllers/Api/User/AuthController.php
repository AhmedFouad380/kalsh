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

    public function checkPhone(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone'=>'required|regex:/(966)[0-9]{8}/',
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

            return callback_data(code_sent(),'otp_sent',$otp);
        }else{ // if not ksa phone
            $user = User::where('phone',$request->phone)->first();
            if (!$user){
                return callback_data(complete_register(),'complete_register');
            }else{
                User::updateOrCreate(['phone' => $request->phone],['phone' => $request->phone, 'otp' => $otp,'password'=>'123456']);
                Mail::send('mail.register_code_mail', ['otp_code' => $otp], function ($message) use ($user) {
                    $message->to($user->email);
                    $message->subject('email verification');
                });
            }
            return callback_data(code_sent(),'otp_sent_mail');
        }
    }

    public function EmailOtp(Request $request){

        $validator = Validator::make($request->all(), [
            'phone'=>'required|unique:users,phone|regex:/(966)[0-9]{8}/',
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
        Mail::send('mail.register_code_mail', ['otp_code' => $otp], function ($message) use ($request){
            $message->to($request->email);
            $message->subject('email verification');
        });
        return callback_data(code_sent(),'otp_sent_mail');

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
        } elseif (!$jwt_token = Auth('user')->attempt(['email' => $request->email,'password' => 123456])) {
            return callback_data(success(),'invalid_otp', (object)[]);
        } else {
            $user = Auth::guard('user')->user();
            $user->device_token = $request->device_token;
            $user->email_verified_at=\Carbon\Carbon::now();
            $user->otp=null;
            $user->save();
            $user->token = $jwt_token;

            return callback_data(success(),'login_success', $user);

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

        $count =  User::where('otp',$request->otp)->where('phone',$request->phone)->count();
        $jwt_token = null;
        if ($count == 0) {
            return callback_data(error(),'invalid_otp', (object)[]);
        } elseif (!$jwt_token = Auth('user')->attempt(['phone' => $request->phone,'password' => '123456','otp'=>$request->otp])) {
            return callback_data(error(),'invalid_otp', (object)[]);

        } else {

            $user = Auth::guard('user')->user();
            $user->device_token = $request->device_token;
            $user->email_verified_at=\Carbon\Carbon::now();
            $user->otp=null;
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





    public function profile()
    {
        $user = User::where('id',Auth::guard('user')->id())->select('name','email','phone');
        return callback_data(success(),'success_response', $user);
    }


    public function updateProfile(Request $request){
        $user = User::find(Auth::guard('user')->id());
        $user->name=$request->name;
        $user->save();

        return callback_data(success(),'save_success', $user);

    }
}
