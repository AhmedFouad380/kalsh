<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceResource;
use App\Http\Resources\SliderResource;
use App\Models\Service;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data['slider'] = SliderResource::make(Slider::where('type',Slider::HOME_TYPE)->active()->first());
        $data['services'] = ServiceResource::collection(Service::active()->orderBy('sort')->get());
        return callback_data(success(),'home',$data);
    }
}
