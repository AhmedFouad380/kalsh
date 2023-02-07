<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function setPasswordAttribute($password)
    {
        if (!empty($password)) {
            $this->attributes['password'] = bcrypt($password);
        }
    }

    public function getImageAttribute($image)
    {
        if (!empty($image)) {
            return asset('uploads/providers') . '/' . $image;
        }
        return asset('defaults/user_default.png');
    }
    public function setImageAttribute($image)
    {
        if (is_file($image)) {
            $img_name = 'provider_' . time() . random_int(0000, 9999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/uploads/providers/'), $img_name);
            $this->attributes['image'] = $img_name;
        }
    }
    public function scopeActive($query): void
    {
        $query->where('status', 'active');
    }


    public function services()
    {
        return $this->belongsToMany(Service::class, 'provider_services', 'provider_id', 'service_id');
    }

    public function readyServices()
    {
        return $this->belongsToMany(ReadyService::class, 'ProviderReadyService', 'provider_id', 'ready_service_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'provider_id');
    }

    public function offers()
    {
        return $this->hasMany(Offer::class, 'provider_id');
    }
}
