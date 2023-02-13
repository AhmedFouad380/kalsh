<?php

namespace App\Http\Controllers\Api\Provider;

use App\Http\Controllers\Controller;
use App\Http\Requests\Provider\providerLoginRequest;
use App\Http\Requests\Provider\ProviderRegistrationRequest;
use App\Models\Provider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use PHPOpenSourceSaver\JWTAuth\JWTAuth;

class AuthController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function check_phone(Request $request)
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
            Provider::updateOrCreate(['phone' => $request->phone],['phone' => $request->phone, 'otp' => $otp,'password'=>'123456']);
            // $this->sms();

        $curl = curl_init();

        $message=  'Your Otp Code is : '.$otp.' ( Klsh App )';
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://REST.GATEWAY.SA/api/SendSMS?api_id=API61856605654&api_password=RiuFeVWosu&sms_type=P&encoding=T&sender_id=SAU61870926055&phonenumber='.$request->phone.'&textmessage='.$message.'',
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


            return callback_data(code_sent(),'otp_sent',(object)[]);

    }



    public function phone_login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'otp' => 'required',
            'phone' => 'required',
            //
            'device_token'=>'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => validation(), 'msg' => $validator->messages()->first(), 'data' => (object)[]], validation());
        }


        $count =  Provider::where('otp',$request->otp)->where('phone',$request->phone)->count();
        $jwt_token = null;
        if ($count == 0) {

            return callback_data(success(),'invalid_otp', (object)[]);

        } elseif (!$jwt_token = Auth('provider')->attempt(['phone' => $request->phone,'password' => '123456','otp'=>$request->otp], ['exp' => \Carbon\Carbon::now()->addDays(7)->timestamp])) {
            return callback_data(success(),'invalid_otp', (object)[]);

        } else {

            $user = Auth::guard('provider')->user();
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
    public function profile()
    {
        $client = Auth::guard('provider')->user();
        return callback_data(success(),'success_response', $client);
    }

    public function updateLocation(Request $request){
        $user = Provider::find(Auth::guard('provider')->id());
        $user->lat=$request->lat;
        $user->lng=$request->lng;
        $user->save();

        return callback_data(success(),'save_success', $user);

    }
    public function updateProfile(Request $request){
        $user = Provider::find(Auth::guard('provider')->id());
        $user->name=$request->name;
        $user->save();

        return callback_data(success(),'save_success', $user);

    }


}
