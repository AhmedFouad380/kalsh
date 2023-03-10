<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Provider extends Authenticatable implements JWTSubject
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $hidden = ['password', 'created_at', 'updated_at'];

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

    public function scopeOnline($query): void
    {
        $query->where('online', 1);
    }


    public function services()
    {
        return $this->belongsToMany(Service::class, 'provider_services', 'provider_id', 'service_id');
    }

    public function readyServices()
    {
        return $this->belongsToMany(ReadyService::class, 'provider_ready_services', 'provider_id', 'ready_service_id');
    }

    public function providerServices()
    {
        return $this->hasMany(ProviderService::class, 'provider_id');
    }

    public function providerReadyServices()
    {
        return $this->hasMany(ProviderReadyService::class, 'provider_id');
    }

    public function providerForms()
    {
        return $this->hasMany(ProviderForm::class, 'provider_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'provider_id');
    }

    public function ordersCompleated()
    {
        return $this->hasMany(Order::class, 'provider_id')->where('status_id', Status::COMPLETED_STATUS);
    }

    public function ordersNotCompleated()
    {
        return $this->hasMany(Order::class, 'provider_id')->where('status_id', '!=', Status::COMPLETED_STATUS);
    }

    public function userRates()
    {
        return $this->hasMany(Rate::class, 'provider_id')->where('type', 'from_user');
    }

    public function offers()
    {
        return $this->hasMany(Offer::class, 'provider_id');
    }


    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
