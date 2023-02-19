<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarService extends Model
{
    use HasFactory;

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

    public function scopeActive($query): void
    {
        $query->where('status', 'active');
    }

    public function scopeParent($query): void
    {
        $query->where('parent_id', 'null');
    }

    public function parent()
    {
        return $this->belongsTo(CarService::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(CarService::class, 'parent_id');
    }
}
