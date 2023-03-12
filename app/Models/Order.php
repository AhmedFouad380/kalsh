<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    const TYPE = ['dream', 'ready', 'limousine', 'delivery', 'package_delivery', 'cars'];

    const PAYMENT_TYPES = ['cash', 'visa'];

    const PAYMENT_STATUS = ['unpaid', 'paid'];

    public function provider()
    {
        return $this->belongsTo(Provider::class, 'provider_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function carType()
    {
        return $this->belongsTo(CarType::class, 'car_type_id');
    }

    public function paymentCard()
    {
        return $this->belongsTo(PaymentCard::class, 'payment_card_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function userRating()
    {
        return $this->hasOne(Rate::class, 'order_id')->where('type', 'from_user');
    }

    public function providerRating()
    {
        return $this->hasOne(Rate::class, 'order_id')->where('type', 'from_provider');
    }

    public function offers()
    {
        return $this->hasMany(Offer::class, 'order_id');
    }

    public function rejectedOrder()
    {
        return $this->hasOne(Offer::class, 'order_id')
            ->where('status_id', Status::CANCELED_BY_PROVIDER_STATUS)
            ->where('provider_id', Auth::guard('provider')->id());
    }

    public function readyService()
    {
        return $this->belongsTo(ReadyService::class, 'ready_service_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function getVoiceAttribute($image)
    {
        if (!empty($image)) {
            return asset('uploads/order_voices') . '/' . $image;
        }
    }

    public function setVoiceAttribute($image)
    {
        if (is_file($image)) {
            $img_name = 'voice_' . time() . random_int(0000, 9999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/uploads/order_voices/'), $img_name);
            $this->attributes['voice'] = $img_name;
        }
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'order_id');
    }

    public static function statusList()
    {
        return [
            Status::PENDING_STATUS => trans(''),
            Status::ACCEPTED_STATUS => trans(''),
            Status::CANCELED_BY_USER_STATUS => trans(''),
            Status::CANCELED_BY_SYSTEM_STATUS => trans(''),
            Status::CANCELED_BY_PROVIDER_STATUS => trans(''),
            Status::COMPLETED_STATUS => trans(''),
            Status::UNKNOWN_STATUS => trans(''),
            Status::REJECTED_STATUS => trans(''),
        ];
    }

    // Return status for show and index pages.
    public function getLocalStatusAttribute()
    {
        return @static::statusList()[$this->status_id];
    }
}
