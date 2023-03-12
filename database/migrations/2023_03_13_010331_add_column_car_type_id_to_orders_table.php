<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddColumnCarTypeIdToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE orders MODIFY payment_type ENUM('cash', 'visa', 'wallet')");
        Schema::table('orders', function (Blueprint $table) {
            $table->foreignId('payment_card_id')->constrained('payment_cards')->restrictOnDelete()->after('payment_status');
            $table->foreignId('car_type_id')->constrained('car_types')->restrictOnDelete()->after('service_id');
//            $table->dropColumn('payment_type');
//            $table->enum('payment_type', ['cash', 'visa', 'wallet'])->default('visa')->after('price');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
        });
    }
}
