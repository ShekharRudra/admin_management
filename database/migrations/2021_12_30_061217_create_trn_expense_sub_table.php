<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrnExpenseSubTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trn_expense_sub', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->unsignedBigInteger('expense_id');
            $table->string('sub_expense_name')->nullable();
            $table->double('planned_amount',10,2);
            $table->tinyInteger('is_favorite')->default(0)->comment     = '1: Favorite, 0: Not Favorite';
            $table->string('note')->nullable();
            $table->integer('sequence_no')->nullable();
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
        Schema::dropIfExists('trn_expense_sub');
    }
}
