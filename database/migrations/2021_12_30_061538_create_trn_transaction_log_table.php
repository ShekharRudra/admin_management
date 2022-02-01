<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrnTransactionLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trn_transaction_log', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('type')->default(0)->comment     = '1: Income, 2: Expense';
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('category_id');
            $table->string('title')->nullable();
            $table->double('amount',10,2);
            $table->tinyInteger('status')->default(0)->comment     = '1: New, 2: Tracked, 3: Deleted';
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
        Schema::dropIfExists('trn_transaction_log');
    }
}
