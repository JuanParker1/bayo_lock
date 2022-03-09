<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractInvestorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract_investor', function (Blueprint $table) {
            $table->unsignedInteger('contract_id');
            $table->unsignedInteger('investor_id');

            $table->foreign('contract_id')->references('id')->on('contracts')->onDelete('cascade');
            $table->foreign('investor_id')->references('id')->on('investors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contract_investor');
    }
}
