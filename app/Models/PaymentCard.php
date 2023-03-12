<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentCard extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id', 'placeholder_name', 'card_number', 'expired_month', 'expired_year', 'status'
    ];

    public function scopeActive($query): void
    {
        $query->where('status', 'active');
    }
}
