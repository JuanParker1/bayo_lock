<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trades', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('cryptocurrency_id');
            $table->decimal('currency-single-price',14,6);
            $table->decimal('total-currency',14,6);
            $table->string('order-day');
            $table->unsignedInteger('location_id');
            $table->timestamps();

            $table->foreign('cryptocurrency_id')->references('id')->on('cryptocurrencies');
            $table->foreign('location_id')->references('id')->on('locations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trade');
    }
}
