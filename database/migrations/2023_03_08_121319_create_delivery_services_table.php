<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_services', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar');
            $table->string('name_en');
            $table->double('min_cost')->default(0);
            $table->double('kilo_cost')->default(0);
            $table->double('min_distance_cost')->default(0);
            $table->double('distance_cost')->default(0);
            $table->integer('range_shop')->default(0);
            $table->integer('range_provider')->default(0);
            $table->integer('range_provider_to_shop')->default(0);
            $table->string('image')->nullable();
            $table->enum('type',['package','delivery'])->default('package');
            $table->enum('status',['active','inactive'])->default('active');
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
        Schema::dropIfExists('delivery_services');
    }
}
