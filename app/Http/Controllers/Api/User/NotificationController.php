<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::where('notifiable_type',User::class)
            ->where('notifiable_id',Auth::guard('user')->id())
            ->orderBy('id','desc')
            ->get();
        return callback_data(success(),'notifications',NotificationResource::collection($notifications));
    }
}
