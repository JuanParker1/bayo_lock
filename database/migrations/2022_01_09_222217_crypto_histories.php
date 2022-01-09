<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CryptoHistories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crypto_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('crypto_id');
            $table->decimal('fees');
            $table->decimal('purchase_price');

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
