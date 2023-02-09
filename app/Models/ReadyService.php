<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReadyService extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $appends = ['name'];

    public function getNameAttribute()
    {
        if (\app()->getLocale() == "ar") {
            return $this->name_ar;
        } else {
            return $this->name_en;
        }
    }

    public function getImageAttribute($image)
    {
        if (!empty($image)) {
            return asset('uploads/ready_services') . '/' . $image;
        }
        return asset('defaults/default_blank.png');
    }

    public function setImageAttribute($image)
    {
        if (is_file($image)) {
            $img_name = 'ready_service_' . time() . random_int(0000, 9999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/uploads/ready_services/'), $img_name);
            $this->attributes['image'] = $img_name;
        }else {
            $this->attributes['image'] = $image;
        }
    }

    public function scopeActive($query): void
    {
        $query->where('status', 'active');
    }

    public function providers()
    {
        return $this->belongsToMany(Provider::class, 'ProviderReadyService', 'ready_service_id', 'provider_id');
    }
}
