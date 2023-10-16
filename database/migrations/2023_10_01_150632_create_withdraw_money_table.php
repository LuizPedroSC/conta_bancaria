<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWithdrawMoneyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdraw_money', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('bank_number');
            $table->integer('branch_number');
            $table->integer('account_number');
            $table->unsignedBigInteger('user_id');
            $table->decimal('withdraw_value');
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
        Schema::dropIfExists('withdraw_money');
    }
}
