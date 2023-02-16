<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PageRescource;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    public function Page(Request $request){
        $validator = Validator::make($request->all(), [
            'type' => 'required|in:user_privacy,provider_privacy,user_terms,provider_terms',

        ]);
        if (!is_array($validator) && $validator->fails()) {
            return callback_data(error(),$validator->errors()->first());
        }
        $data = Page::where('type',$request->type)->first();

        return callback_data(success(),'success_response',PageRescource::make($data));

    }
}
