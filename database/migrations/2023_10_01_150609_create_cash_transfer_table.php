<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashTransferTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_transfer', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedBigInteger('user_id');
            $table->integer('bank_number_sender');
            $table->integer('branch_number_sender');
            $table->integer('account_number_sender');
            $table->integer('bank_number_recipient');
            $table->integer('branch_number_recipient');
            $table->integer('account_number_recipient');
            $table->decimal('deposit_value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transfer_money');
    }
}
