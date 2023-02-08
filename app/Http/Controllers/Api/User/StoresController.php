<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceResource;
use App\Http\Resources\SliderResource;
use App\Http\Resources\StoreResource;
use App\Models\Service;
use App\Models\Slider;
use App\Models\Store;
use Illuminate\Http\Request;

class StoresController extends Controller
{
    public function index()
    {
        $stores = StoreResource::collection(Store::active()->orderBy('sort')->get());
        return callback_data(success(),'stores',$stores);
    }
}
