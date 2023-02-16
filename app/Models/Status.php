<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    const PENDING_STATUS = 1;
    const ACCEPTED_STATUS = 2;
    const CANCELED_BY_USER_STATUS = 3;
    const CANCELED_BY_SYSTEM_STATUS = 4;
    const CANCELED_BY_PROVIDER_STATUS = 5;
    const COMPLETED_STATUS = 6;
    const UNKNOWN_STATUS = 7;
    const REJECTED_BY_USER_STATUS = 8;
    const REJECTED_BY_PROVIDER_STATUS = 9;





    protected $guarded = ['id', 'created_at', 'updated_at'];


}
