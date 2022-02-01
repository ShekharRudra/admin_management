<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstLearnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        Schema::create('mst_learn', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('learn_library_id');
            $table->unsignedBigInteger('plan_id');
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->integer('sequence_no')->nullable();
            $table->tinyInteger('is_active')->default(1)->comment     = '1: Active, 0: InActive';
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
        Schema::dropIfExists('mst_learn');
    }
}
