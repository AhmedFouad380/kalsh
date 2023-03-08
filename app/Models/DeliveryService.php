<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryService extends Model
{
    use HasFactory;

    protected $guarded = [''];

    protected $appends = ['name'];

    public function getNameAttribute()
    {
        if (\app()->getLocale() == "ar") {
            return $this->name_ar;
        } else {
            return $this->name_en;
        }
    }

    public function scopeActive($query): void
    {
        $query->where('status', 'active');
    }


    public function getImageAttribute($image)
    {
        if (!empty($image)) {
            return asset('defaults') . '/' . $image;
        }
        return asset('defaults/default_blank.png');
    }

    public function setImageAttribute($image)
    {
        if (is_file($image)) {
            $img_name = 'delivery_service_' . time() . random_int(0000, 9999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/defaults/'), $img_name);
            $this->attributes['image'] = $img_name;
        } else {
            $this->attributes['image'] = $image;
        }
    }


}
