<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
class CreateMstParameterValueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_parameter_value', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parameter_type_id');
            $table->string('parameter_value_code')->nullable();
            $table->string('parameter_value')->nullable();
            $table->string('accepted_values')->nullable();
            $table->string('image_link')->nullable();
            $table->integer('sequence_no')->nullable();
            $table->tinyInteger('is_active')->default(1)->comment     = '1: Active, 0: InActive';
            $table->string('remark')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        DB::statement("INSERT INTO `mst_parameter_value` (`id`, `parameter_type_id`, `parameter_value_code`, `parameter_value`, `accepted_values`, `image_link`, `sequence_no`, `is_active`, `remark`, `created_at`, `updated_at`, `deleted_at`) VALUES
        (1, 1, 'Giving', 'Giving', 'Giving', NULL, 1, 1, 'Giving', '2021-12-05 23:59:29', '2021-12-05 23:59:29', NULL),
        (2, 1, 'Savings', 'Savings', 'Savings', NULL, 2, 1, 'Savings', '2021-12-06 00:00:04', '2021-12-06 00:00:04', NULL),
        (3, 1, 'Housing', 'Housing', 'Housing', NULL, 3, 1, 'Housing', '2021-12-06 00:00:20', '2021-12-06 00:00:20', NULL),
        (4, 1, 'Transportation', 'Transportation', 'Transportation', NULL, 4, 1, 'Transportation', '2021-12-06 00:00:34', '2021-12-06 00:00:34', NULL),
        (5, 1, 'Food', 'Food', 'Food', NULL, 5, 1, 'Food', '2021-12-06 00:00:48', '2021-12-06 00:00:48', NULL),
        (6, 1, 'Personal', 'Personal', 'Personal', NULL, 6, 1, 'Personal', '2021-12-06 00:01:15', '2021-12-06 00:01:15', NULL),
        (7, 1, 'Lifestyle', 'Lifestyle', 'Lifestyle', NULL, 7, 1, 'Lifestyle', '2021-12-06 00:01:30', '2021-12-06 00:01:30', NULL),
        (8, 1, 'Health', 'Health', 'Health', NULL, 8, 1, 'Health', '2021-12-06 00:09:32', '2021-12-06 00:16:08', NULL),
        (9, 1, 'Insurance', 'Insurance', 'Insurance', NULL, 9, 1, 'Insurance', '2021-12-06 00:09:32', '2021-12-06 00:16:08', NULL),
        (10, 1, 'Debt', 'Debt', 'Debt', NULL, 10, 1, 'Debt', '2021-12-06 00:09:32', '2021-12-06 00:16:08', NULL),
        (11, 2, 'Paycheck 1', 'Paycheck 1', 'Paycheck 1', NULL, 11, 1, 'Paycheck 1', '2021-12-06 00:09:32', '2021-12-06 00:16:08', NULL),
        (12, 2, 'Paycheck 2', 'Paycheck 2', 'Paycheck 2', NULL, 12, 1, 'Paycheck 2', '2021-12-06 00:09:32', '2021-12-06 00:16:08', NULL)");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mst_parameter_value');
    }
}
