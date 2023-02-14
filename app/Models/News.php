<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use HasFactory ,SoftDeletes;

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
            return asset('uploads/news') . '/' . $image;
        }
        return asset('defaults/default_blank.png');
    }

    public function setImageAttribute($image)
    {
        if (is_file($image)) {
            $imageFields = upload($image, 'news');
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
