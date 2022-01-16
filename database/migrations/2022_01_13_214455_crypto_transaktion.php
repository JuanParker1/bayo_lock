<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CryptoTransaktion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crypto_transaktion', function (Blueprint $table) {
            $table->unsignedInteger('crypto_id');
            $table->unsignedInteger('transaktion_id');

            $table->foreign('transaktion_id')->references('id')->on('transaktions');
            $table->foreign('crypto_id')->references('id')->on('cryptos');
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
