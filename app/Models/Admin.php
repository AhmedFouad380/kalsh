<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory,SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function setPasswordAttribute($password)
    {
        if (!empty($password)) {
            $this->attributes['password'] = bcrypt($password);
        }
    }

    public function scopeActive($query): void
    {
        $query->where('status', 'active');
    }

    public function getImageAttribute($image)
    {
        if (!empty($image)) {
            return asset('uploads/admins') . '/' . $image;
        }
        return asset('defaults/user_default.png');
    }
    public function setImageAttribute($image)
    {
        if (is_file($image)) {
            $img_name = 'admin_' . time() . random_int(0000, 9999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/uploads/admins/'), $img_name);
            $this->attributes['image'] = $img_name;
        }
    }
}
