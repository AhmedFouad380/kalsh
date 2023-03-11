<?php

use App\Models\CarType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarTypePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_type_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_type_id')->constrained('car_types')->cascadeOnDelete();
            $table->double('from');
            $table->double('to');
            $table->double('price_per_km');
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
        Schema::dropIfExists('car_type_prices');
    }
}
