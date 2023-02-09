<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory,SoftDeletes;

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

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function readyService()
    {
        return $this->belongsTo(ReadyService::class, 'ready_service_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
}
