<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractDepositTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract_deposit', function (Blueprint $table) {
            $table->unsignedInteger('contract_id');
            $table->unsignedInteger('deposit_id');

            $table->foreign('contract_id')->references('id')->on('contracts')->onDelete('cascade');
            $table->foreign('deposit_id')->references('id')->on('deposits')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contract_deposit');
    }
}
