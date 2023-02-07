<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderReadyService extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function provider()
    {
        return $this->belongsTo(Provider::class, 'provider_id');
    }

    public function readyService()
    {
        return $this->belongsTo(ReadyService::class, 'ready_service_id');
    }
}
