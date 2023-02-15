<?php

namespace App\Http\Controllers\Api\Provider;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;
use App\Models\Notification;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class       NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::where('notifiable_type',Provider::class)
            ->where('notifiable_id',Auth::guard('provider')->id())
            ->orderBy('id','desc')
            ->get();
        return callback_data(success(),'notifications',NotificationResource::collection($notifications));
    }
}
