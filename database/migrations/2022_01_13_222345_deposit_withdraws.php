<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DepositWithdraws extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposit_withdraws', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('payment');
            $table->unsignedInteger('payment_method_id');
            $table->string('mode',10);
            $table->date('receive_date');

            $table->foreign('payment_method_id')->references('id')->on('payment_methods');;
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
