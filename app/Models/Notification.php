<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
    use HasFactory;

    const NEW_ORDER_TYPE = 'new_order';
    const NEW_OFFER_TYPE = 'new_offer';
    const ACCEPT_OFFER_TYPE = 'accept_offer';
    const ACCEPT_ORDER_TYPE = 'accept_order';
    const START_ORDER_TYPE = 'start_order';
    const REJECT_ORDER_TYPE = 'reject_order';
    const COMPLETE_ORDER_TYPE = 'complete_order';
    const ARRIVED_ORDER_TYPE = 'arrived';

    protected $fillable = [
        'type',
        'notifiable_type',
        'notifiable_id',
        'order_id',
        'offer_id',
        'title_ar',
        'title_en',
        'description_ar',
        'description_en',
    ];

    protected $appends = ['title', 'description'];

    public function getTitleAttribute()
    {
        if (\app()->getLocale() == "ar") {
            return $this->title_ar;
        } else {
            return $this->title_en;
        }
    }

    public function getDescriptionAttribute()
    {
        if (\app()->getLocale() == "ar") {
            return $this->description_ar;
        } else {
            return $this->description_en;
        }
    }

    public function notifiable()
    {
        return $this->morphTo();
    }

    public function order()
    {
        return $this->belongsTo(Order::class,'order_id');
    }

    public function offer()
    {
        return $this->belongsTo(Offer::class,'offer_id');
    }
}
