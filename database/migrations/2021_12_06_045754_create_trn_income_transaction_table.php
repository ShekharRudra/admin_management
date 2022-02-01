<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrnIncomeTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trn_income_transaction', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->unsignedBigInteger('income_id');
            $table->double('amount',10,2);
            $table->string('title')->nullable();
            $table->string('transaction_check')->nullable();
            $table->string('transaction_note')->nullable();
            $table->tinyInteger('original_status')->default(2)->comment     = '1: New, 2: Tracked';
            $table->tinyInteger('status')->default(2)->comment     = '1: New, 2: Tracked, 3: Deleted';
            $table->date('date_time')->nullable();
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trn_income_transaction');
    }
}
