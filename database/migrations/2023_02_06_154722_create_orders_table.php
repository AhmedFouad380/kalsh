<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->enum('type',['dream','ready','limousine','delivery','package_delivery','cars']);
            $table->foreignId('user_id')->constrained('users')->restrictOnDelete();
            $table->foreignId('provider_id')->nullable()->constrained('providers')->restrictOnDelete();
            $table->foreignId('service_id')->constrained('services')->restrictOnDelete();
            $table->foreignId('ready_service_id')->nullable()->constrained('ready_services')->restrictOnDelete();
            $table->foreignId('status_id')->default(1)->constrained('statuses')->restrictOnDelete();
            $table->integer('radius')->nullable();
            $table->text('description')->nullable();
            $table->string('voice')->nullable();
            $table->string('from_lat')->nullable();
            $table->string('from_lng')->nullable();
            $table->string('to_lat')->nullable();
            $table->string('to_lng')->nullable();
            $table->double('price')->nullable();
            $table->enum('payment_type',['cash','visa'])->default('visa');
            $table->enum('payment_status',['unpaid','paid'])->default('unpaid');
            $table->tinyInteger('user_rated')->default(0);
            $table->tinyInteger('provider_rated')->default(0);
            $table->softDeletes();
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
        Schema::dropIfExists('orders');
    }
}
