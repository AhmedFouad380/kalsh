<?php

use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

use Illuminate\Support\Facades\Notification;
use Kreait\Firebase\Factory;

//use Kreait\Firebase\Factory;

// Status Codes
function success()
{
    return 200;
}

function error()
{
    return 401;
}

function negative_wallet()
{
    return 402;
}

function token_expired()
{
    return 403;
}

function not_active()
{
    return 405;
}

function not_found()
{
    return 404;
}


function nearest_radius()
{
    return 50000000000; // 30km
}

function google_api_key()
{
    return "AIzaSyAGlTpZIZ49RVV5VX8KhzafRqjzaTRbnn0";
}

function verification_code()
{
    $code = mt_rand(1000, 9999);
//    $code = 1111;
    return $code;
}

function send_to_user($tokens, $msg, $ad_id = "")
{
    send($tokens, $msg, $ad_id);
}

function send_to_company($company, $msg)
{
    Notification::send($company, new CompanyNotification($msg));
}

function send_to_driver($tokens, $msg, $ad_id = "")
{
    send($tokens, $msg, $ad_id);
}

function send($tokens, $title = "رسالة جديدة", $msg = "رسالة جديدة فى البريد", $type = 'mail', $chat = null)
{

    $key = getServerKey();


    $fields = array
    (
        "registration_ids" => (array)$tokens,  //array of user token whom notification sent two
        "priority" => 10,
        'data' => [
            'title' => $title,
            'body' => $msg,
            'inbox' => $chat,
            'type' => $type,
            'icon' => 'myIcon',
            'sound' => 'mySound',
        ],
        'notification' => [
            'title' => $title,
            'body' => $msg,
            'inbox' => $chat,
            'type' => $type,
            'icon' => 'myIcon',
            'sound' => 'mySound',
        ],
        'vibrate' => 1,
        'sound' => 1
    );

    $headers = array
    (
        'accept: application/json',
        'Content-Type: application/json',
        'Authorization: key=' . $key
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    $result = curl_exec($ch);

    if ($result === FALSE) {

        die('Curl failed: ' . curl_error($ch));
    }

    curl_close($ch);
    return $result;
}


function getServerKey()
{
    return 'AAAAdbmfZjU:APA91bG_-TjuYGuGoaImm08h7MbRIWtO_WE3G_ipzeahHtSakIx3kgtM1Tps3QCldL33WDWnecAeMiPDVBTVy0PWQz3W5ZdqQCxZHDzurffxnyZEh1Bn2ipoPDcWpXrIWzZnJ7U0SoUn';
}

function callback_data($status, $key, $data = null, $token = "")
{
    $language = request()->header('lang');
    $response = [
        'status' => $status,
        'msg' => isset($language) ? Config::get('response.' . $key . '.' . request()->header('lang')) : Config::get('response.' . $key),
        'data' => $data,
    ];
    $token ? $response['token'] = $token : '';
    return response()->json($response);
}

function getDays($from_date, $to_date)
{
    $diff_in_days = 0;
    if ($from_date && $to_date) {
        $to = \Carbon\Carbon::parse($to_date);
        $from = \Carbon\Carbon::parse($from_date);
        $diff_in_days = $to->diffInDays($from);
    }
    return $diff_in_days;
}

function getTotalCost($unit, $from_date, $to_date)
{
    $total_cost = 0;
    if (!empty($from_date) && !empty($to_date)) {
        $period = CarbonPeriod::create(getStartOfDate($from_date), getEndOfDate(Carbon::parse($to_date)->subDay()));
        foreach ($period as $date) {
            $day = Carbon::parse($date)->format('l');
            if (in_array($day, ['Thursday', 'Friday', 'Saturday'])) {
                $total_cost += $unit->{strtolower($day) . '_price'};
            } else {
                $total_cost += $unit->midweek_price;
            }
        }
//        session()->put('total_cost', $total_cost);
    }
    if ($unit->offers->count() > 0) {
//        return
        $total_cost = $unit->offers->first()->amount;

    }
    return $total_cost;
}

function GetDiscount($unit, $from_date, $to_date, $code)
{
    $total_cost = 0;
    if (!empty($from_date) && !empty($to_date)) {
        $period = CarbonPeriod::create(getStartOfDate($from_date), getEndOfDate(Carbon::parse($to_date)->subDay()));
        foreach ($period as $date) {
            $day = Carbon::parse($date)->format('l');
            if (in_array($day, ['Thursday', 'Friday', 'Saturday'])) {
                $total_cost += $unit->{strtolower($day) . '_price'};
            } else {
                $total_cost += $unit->midweek_price;
            }
        }


        if ($unit->offers->count() > 0) {
            $total_cost = $unit->offers->first()->amount;

        }

        if ($code != null) {
            if ($code->unit_id == $unit->id) {
                if ($code->type == "Amount") {
                    $total_cost = $total_cost - $code->amount;
                } else {
                    $total_cost = ceil(($total_cost * $code->amount) / 100);
                }
            }
        }
    }

    return $total_cost;
}

function getTotalWithVat($unit, $from_date, $to_date)
{
    $total_cost = getTotalCost($unit, $from_date, $to_date);
    $vat = ceil(($total_cost * 15) / 100);
    return $total_cost + $vat;
}


function getStartOfDate($date)
{
    return date('Y-m-d', strtotime($date)) . ' 00:00';
}

function getEndOfDate($date)
{
    return date('Y-m-d', strtotime($date)) . ' 23:59';
}

if (!function_exists('ArabicDate')) {
    function ArabicDate()
    {
        $months = array("Jan" => "يناير", "Feb" => "فبراير", "Mar" => "مارس", "Apr" => "أبريل", "May" => "مايو", "Jun" => "يونيو", "Jul" => "يوليو", "Aug" => "أغسطس", "Sep" => "سبتمبر", "Oct" => "أكتوبر", "Nov" => "نوفمبر", "Dec" => "ديسمبر");
        $your_date = date('y-m-d'); // The Current Date
        $en_month = date("M", strtotime($your_date));
        foreach ($months as $en => $ar) {
            if ($en == $en_month) {
                $ar_month = $ar;
            }
        }

        $find = array("Sat", "Sun", "Mon", "Tue", "Wed", "Thu", "Fri");
        $replace = array("السبت", "الأحد", "الإثنين", "الثلاثاء", "الأربعاء", "الخميس", "الجمعة");
        $ar_day_format = date('D'); // The Current Day
        $ar_day = str_replace($find, $replace, $ar_day_format);

        header('Content-Type: text/html; charset=utf-8');
        $standard = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
        $eastern_arabic_symbols = array("٠", "١", "٢", "٣", "٤", "٥", "٦", "٧", "٨", "٩");
        $current_date = $ar_day . ' - ' . date('d') . ' ' . $ar_month . ' ' . date('Y');
        $arabic_date = str_replace($standard, $eastern_arabic_symbols, $current_date);

        return $arabic_date;
    }
}


function distance($lat1, $lon1, $lat2, $lon2, $unit = 'K')
{
    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    $unit = strtoupper($unit);

    if ($unit == "K") {
        return ($miles * 1.609344);
    } else if ($unit == "N") {
        return ($miles * 0.8684);
    } else {
        return $miles;
    }

}

function upload($file, $dir)
{
    $image = time() . uniqid() . '.' . $file->getClientOriginalExtension();
    $file->move('uploads' . '/' . $dir, $image);
    return $image;
}

function unlinkFile($image, $path)
{
    if ($image != null) {
        if (!strpos($image, 'https')) {
            if (file_exists(public_path("uploads/$path/") . $image)) {
                unlink(public_path("uploads/$path/") . $image);
            }
        }
    }
    return true;
}


function unlinkImage($image)
{
    if ($image != null) {
        if (!strpos($image, 'https')) {
            if (file_exists($image)) {
                unlink($image);
            }
        }
    }
    return true;
}

// Firebase Connect

function firebase_connect()
{
    $firebase = (new Factory)
        ->withServiceAccount(app_path('handtohandapp-c0717-firebase-adminsdk-xktcv-b3dcd0eddc.json'))
        ->withDatabaseUri('https://handtohandapp-c0717-default-rtdb.firebaseio.com/')
        ->createDatabase();
    return $firebase;
}

function driverChangeOrderStatus($status, $order_type)
{
    if ($order_type == 'Magic') {
        return [
            'AcceptedDelivery' => 'GoToStore',
            'GoToStore' => 'ArriveToStore', // 3
            'ArriveToStore' => 'SendPriceList', // 4
            'AcceptedList' => 'OnWay', // 6
            'OnWay' => 'Arrived',
            'Arrived' => 'Completed',
        ][$status];
    }
    // subscribed
    return [
        'AcceptedDelivery' => 'GoToStore',
        'GoToStore' => 'ArriveToStore', // 3
        'ArriveToStore' => 'OnWay', // 6
        'OnWay' => 'Arrived',
        'Arrived' => 'Completed',
    ][$status];
}

// Admin Helper Functions

if (!function_exists('company_parent')) {
    function company_parent()
    {
        if (Auth::guard('companies')->user()->type == 'Admin') {
            return Auth::guard('companies')->user()->id;
        } else {
            return Auth::guard('companies')->user()->company_id;
        }
    }
}

if (!function_exists('admin_url')) {
    function admin_url($url = null)
    {
        return url('admin/' . $url);
    }
}


if (!function_exists('company_url')) {
    function company_url($url = null)
    {
        return url('company/' . $url);
    }
}


if (!function_exists('admin')) {
    function admin()
    {
        return auth()->guard('admins');
    }
}


function msgdata($request, $status, $key, $data)
{
    $language = request()->header('lang');

    $msg['status'] = $status;
    $msg['msg'] = isset($language) ? Config::get('response.' . $key . '.' . request()->header('lang')) : Config::get('response.' . $key . '.ar');

    $msg['data'] = $data;

    return $msg;
}


if (!function_exists('auth_login')) {
    function auth_login()
    {
        if (Auth::guard('admins')->check()) {
            return auth()->guard('admins');
        }
        if (Auth::guard('suppliers')->check()) {
            return auth()->guard('suppliers');
        }
    }
}


if (!function_exists('supplier_parent')) {
    function supplier_parent()
    {
        if (Auth::guard('suppliers')->check()) {
//            if (Auth::guard('suppliers')->user()->type == 'Manager') {
            return Auth::guard('suppliers')->user()->id;
//            } else {
//                return Auth::guard('suppliers')->user()->parent_id;
//            }
        }
    }
}

if (!function_exists('supplier_parent_api')) {
    function supplier_parent_api()
    {
        return Auth::guard('suppliers-api')->user()->id;

    }

}

if (!function_exists('supplier_parent2')) {
    function supplier_parent2($id)
    {
//        if (\App\Models\Supplier::find($id)->type == 'Manager') {
        return \App\Models\Supplier::find($id)->id;
//        } else {
//        return \App\Models\Supplier::find($id)->parent_id;
//        }
    }
}

if (!function_exists('sms')) {
    function sms($body, $number)
    {
        $ch = curl_init();
        $url = "http://basic.unifonic.com/rest/SMS/messages";
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "AppSid=ngKAr3bTdAMthOzNZumtHX3DaEuJEx&Body=" . $body . "&SenderID=AMAR-TICK&Recipient=" . $number . "&encoding=UTF8&responseType=json"); // define what you want to post
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);
    }
}

if (!function_exists('firebaseValues')) {
    function firebaseValues()
    {
        $firebase = (new Factory)
            ->withServiceAccount(app_path('amartech-69196-firebase-adminsdk-q996n-4cb7b7513a.json'))
            ->withDatabaseUri('https://amartech-69196-default-rtdb.firebaseio.com/')
            ->createDatabase();
        if (Auth::guard('admins')->check()) {
            $getadmins_mail = $firebase
                ->getReference('amar/inboxes')
                ->orderByChild('receiver_type')
                ->equalTo('admin')
                ->limitToLast(20)
                ->getValue();
            return $getadmins_mail;
        } else {
            $getadmins_mail = $firebase
                ->getReference('amar/inboxes')
                ->orderByChild('filter_type_receiver_id')
                ->equalTo('supplier_' . supplier_parent())
//                ->orderByChild('receiver_id')
//                ->equalTo(supplier_parent())
                ->limitToLast(20)
                ->getValue();
            return $getadmins_mail;
        }
    }


}







