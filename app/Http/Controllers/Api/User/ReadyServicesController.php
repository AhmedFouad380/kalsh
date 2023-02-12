<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReadyServiceResource;
use App\Models\ReadyService;
use Illuminate\Http\Request;

class ReadyServicesController extends Controller
{
    public function index()
    {
        $readyServices = ReadyServiceResource::collection(ReadyService::active()->orderBy('sort')->get());
        return callback_data(success(),'readyServices',$readyServices);
    }
}
