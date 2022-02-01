<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstPlanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_plan', function (Blueprint $table) {
            $table->id();
            $table->string('plan_name')->nullable();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->tinyInteger('month')->comment = 'Plan in month';
            $table->double('amount',10,2);
            $table->tinyInteger('plan_type')->default(1)->comment     = '1:Free, 2: Paid';
            $table->tinyInteger('is_active')->default(1)->comment     = '1: Active, 0: Inactive';
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
        Schema::dropIfExists('mst_plan');
    }
}
