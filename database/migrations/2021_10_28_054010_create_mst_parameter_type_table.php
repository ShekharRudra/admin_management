<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
class CreateMstParameterTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_parameter_type', function (Blueprint $table) {
            $table->id();
            $table->string('parameter_type_name');
            $table->tinyInteger('is_active')->default(1)->comment     = '1: Active, 0: InActive';
            $table->string('remark')->nullable();
            $table->timestamps();
            $table->softDeletes();
        }); 
        DB::statement("INSERT INTO `mst_parameter_type` (`id`, `parameter_type_name`, `is_active`, `remark`, `created_at`, `updated_at`) VALUES
        (1, 'Expense Category', 1, 'Expense Category', NULL, NULL),
        (2, 'Income Category', 1, 'Expense Category', NULL, NULL)");
      

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mst_parameter_type');
    }
}
