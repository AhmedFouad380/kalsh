<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarType extends Model
{
    use HasFactory;

    protected $fillable = [
        "name_ar",
        "name_en",
        "start_price",
        "status",
    ];

    protected $appends = ['name'];

    public function carTypePrices()
    {
        return $this->hasMany(CarTypePrice::class, 'car_type_id');
    }

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
            return asset('uploads/car_types') . '/' . $image;
        }
        return asset('defaults/default_blank.png');
    }

    public function setImageAttribute($image)
    {
        if (is_file($image)) {
            $imageFields = upload($image, 'car_types');
            $this->attributes['image'] = $imageFields;
        } else {
            $this->attributes['image'] = $image;
        }
    }

    public function scopeActive($query): void
    {
        $query->where('status', 'active');
    }
}
