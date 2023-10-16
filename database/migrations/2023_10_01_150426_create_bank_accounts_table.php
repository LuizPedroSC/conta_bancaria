<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->integer('bank_number');
            $table->integer('branch_number');
            $table->integer('account_number');
            $table->string('password');
            $table->unsignedBigInteger('user_id');
            $table->unsignedDecimal('balance', 10, 2)->default(0);
            $table->char('account_type', 1);
            $table->dateTime('opening_date');
            $table->char('account_status')->default('B');
            $table->timestamps();
            $table->primary(['bank_number', 'branch_number', 'account_number']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bank_accounts');
    }
}
