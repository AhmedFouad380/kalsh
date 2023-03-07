<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarTypePrice extends Model
{
    use HasFactory;

    protected $fillable = [
        "car_type_id",
        "from",
        "to",
        "price_per_km",
    ];

    public function carType()
    {
        return $this->belongsTo(CarType::class, 'car_type_id');
    }
}
