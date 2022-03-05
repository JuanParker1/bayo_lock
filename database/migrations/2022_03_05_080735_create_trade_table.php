<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTradeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trade', function (Blueprint $table) {
            $table->increments('id');
            $table->string('currency');
            $table->float('currency-single-price');
            $table->string('used-coin');
            $table->bigInteger('used-coin-size');
            $table->bigInteger('fees');
            $table->bigInteger('total-currency');
            $table->string('order-day');
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
        Schema::dropIfExists('trade');
    }
}
