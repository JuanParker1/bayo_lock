<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class WayOfHistories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('way_of_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('crypto_id');
            $table->unsignedInteger('marketplace_id');
            $table->string('crypto_api_id');
            $table->tinyInteger('order_number');
            $table->decimal('purchase_price');
            $table->decimal('fees');

            $table->foreign('crypto_id')->references('id')->on('cryptos');
            $table->foreign('marketplace_id')->references('id')->on('marketplaces');
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
