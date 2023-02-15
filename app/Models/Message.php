<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use HasFactory,SoftDeletes;
    protected $appends =['sender_name'];
    protected $guarded = ['id', 'created_at', 'updated_at'];


      public function getSenderNameAttribute(){
          if($this->sender_type == 'App\Models\User'){
              return  User::find($this->sender_id)->name;
          }else{
              return  Provider::find($this->sender_id)->name;
          }
      }
}
