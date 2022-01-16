<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DepositWithdrawTransaktionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposit_withdraw_transaktion', function (Blueprint $table) {
            $table->unsignedInteger('deposit_withdraw_id');
            $table->unsignedInteger('transaktion_id');

            $table->foreign('transaktion_id')->references('id')->on('transaktions');
            $table->foreign('deposit_withdraw_id')->references('id')->on('deposit_withdraws');
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
