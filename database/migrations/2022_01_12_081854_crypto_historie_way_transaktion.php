<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CryptoHistorieWayTransaktion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crypto_historie_way_transaktion', function (Blueprint $table) {
            $table->unsignedInteger('crypto_historie_id');
            $table->unsignedInteger('transaktion_id');

            $table->foreign('transaktion_id')->references('id')->on('transaktions');
            $table->foreign('crypto_historie_id')->references('id')->on('crypto_histories');
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
