<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CryptocurrencyTrade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cryptocurrency_trade', function (Blueprint $table) {
            $table->unsignedInteger('trade_id');
            $table->unsignedInteger('currency_id');

            $table->foreign('trade_id')->references('id')->on('trades')->onDelete('cascade');
            $table->foreign('currency_id')->references('id')->on('cryptocurrencies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
