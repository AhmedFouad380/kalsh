<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\NewsResource;
use App\Http\Resources\ServiceResource;
use App\Http\Resources\SliderResource;
use App\Http\Resources\StoreResource;
use App\Models\News;
use App\Models\Service;
use App\Models\Slider;
use App\Models\Store;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = NewsResource::collection(News::active()->orderBy('sort')->get());
            return callback_data(success(),'news',$news);
    }
}
