<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slider extends Model
{
    use HasFactory,SoftDeletes;

    const HOME_TYPE = 'home';
    const STORES_TYPE = 'stores';
    const PRAY_TYPE = 'pray';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $appends = ['name'];

    public function scopeActive($query)
    {
        return $query->where('status','active');
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
            return asset('uploads/sliders') . '/' . $image;
        }
        return asset('defaults/default_blank.png');
    }
    public function setImageAttribute($image)
    {
        if (is_file($image)) {
            $img_name = 'slider_' . time() . random_int(0000, 9999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/uploads/sliders/'), $img_name);
            $this->attributes['image'] = $img_name;
        }else {
            $this->attributes['image'] = $image;
        }
    }

}
