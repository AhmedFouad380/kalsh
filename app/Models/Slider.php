<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    const TYPE = ['home', 'stores', 'pray'];

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
        }
    }

    public function scopeActive($query): void
    {
        $query->where('status', 'active');
    }

}
