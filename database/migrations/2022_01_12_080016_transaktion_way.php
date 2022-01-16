<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TransaktionWay extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaktion_way', function (Blueprint $table) {
            $table->unsignedInteger('transaktion_id');
            $table->unsignedInteger('way_id');

            $table->foreign('transaktion_id')->references('id')->on('transaktions');
            $table->foreign('way_id')->references('id')->on('way_of_histories');
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
