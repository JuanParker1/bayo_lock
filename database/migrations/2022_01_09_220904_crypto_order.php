<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CryptoOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crypto_order', function (Blueprint $table) {
            $table->unsignedInteger('order_id');
            $table->unsignedInteger('crypto_id');

            $table->foreign('order_id')->references('id')->on('orders');
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
