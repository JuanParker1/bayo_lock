<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DepositWithdrawOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposit_withdraw_order', function (Blueprint $table) {
            $table->unsignedInteger('deposit_withdraw_id');
            $table->unsignedInteger('order_id');

            $table->foreign('order_id')->references('id')->on('orders');
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
