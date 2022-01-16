<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Transaktion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaktions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('marketplace_id');
            $table->unsignedInteger('wallet_id');
            $table->unsignedInteger('network_id');
            $table->decimal('trans_fees');
            $table->string('send_to');

            $table->foreign('marketplace_id')->references('id')->on('marketplaces');
            $table->foreign('wallet_id')->references('id')->on('wallets');
            $table->foreign('network_id')->references('id')->on('networks');
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
