<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('phone')->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->integer('otp')->nullable();
            $table->string('image')->nullable();
            $table->double('rate')->default(0);
            $table->enum('status',['active','inactive'])->default('active');
            $table->enum('location',['in_ksa','out_ksa'])->default('in_ksa');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('device_token')->nullable();
            $table->softDeletes();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
