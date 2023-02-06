<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Admin;
use App\Models\Cart;
use App\Models\Category;
use App\Models\ContactForm;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Page;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Shape;
use App\Models\User;
use App\Models\Wishlist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use Session;

class frontController extends Controller
{

    public function home(){
        return view('front.index');
    }
    public function login(Request $request){

        $credentials = $request->only('email', 'password');
        $remember_me = $request->has('remember_me') ? true : false;


        if (Auth::guard('admin')->attempt($credentials ,$remember_me)) {
            // Authentication passed...
            return redirect()->intended('/');
        }
        else {
            return back()->with('error', '');
        }

    }

    public function logout(){
        if(Auth::guard('admin')->check()){
            Auth::guard('admin')->logout();

        }
        if(Auth::guard('web')->check()){
        Auth::guard('web')->logout();
        }
            return redirect('/')->with('message','success');
    }

    public function register(){
        return view('front.register');
    }



    public function Setting(){

            $employee = Admin::findOrFail(Auth::guard('admin')->id());

        return view('Admin.Admin.Profile',compact('employee'));
    }
}
