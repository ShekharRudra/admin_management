<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstSubCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_sub_category', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->string('sub_category')->nullable();
            $table->tinyInteger('is_active')->default(1)->comment     = '1: Active, 0: Inactive';
            $table->timestamps();
            $table->softDeletes();
        });
        DB::statement("INSERT INTO `mst_sub_category` (`id`, `category_id`, `sub_category`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
        (1, 1, 'Church',1,'2021-12-05 23:59:29', '2021-12-05 23:59:29', NULL),
        (2, 1, 'Charity',1,'2021-12-05 23:59:29', '2021-12-05 23:59:29', NULL),
        (3, 2, 'Emergency Fund',1,'2021-12-05 23:59:29', '2021-12-05 23:59:29', NULL),
        (4, 3, 'Mortgage/Rent',1,'2021-12-05 23:59:29', '2021-12-05 23:59:29', NULL),
        (5, 3, 'Water',1,'2021-12-05 23:59:29', '2021-12-05 23:59:29', NULL),
        (6, 3, 'Natural Gas',1,'2021-12-05 23:59:29', '2021-12-05 23:59:29', NULL),
        (7, 3, 'Electricity',1,'2021-12-05 23:59:29', '2021-12-05 23:59:29', NULL),
        (8, 3, 'Cable',1,'2021-12-05 23:59:29', '2021-12-05 23:59:29', NULL),
        (9, 3, 'Trash',1,'2021-12-05 23:59:29', '2021-12-05 23:59:29', NULL),
        (10, 4, 'Gas',1,'2021-12-05 23:59:29', '2021-12-05 23:59:29', NULL),
        (11, 4, 'Maintenance',1,'2021-12-05 23:59:29', '2021-12-05 23:59:29', NULL),
        (12, 5, 'Groceries',1,'2021-12-05 23:59:29', '2021-12-05 23:59:29', NULL),
        (13, 5, 'Restaurants',1,'2021-12-05 23:59:29', '2021-12-05 23:59:29', NULL),
        (14, 6, 'Clothing',1,'2021-12-05 23:59:29', '2021-12-05 23:59:29', NULL),
        (15, 6, 'Phone',1,'2021-12-05 23:59:29', '2021-12-05 23:59:29', NULL),
        (16, 6, 'Fun Money',1,'2021-12-05 23:59:29', '2021-12-05 23:59:29', NULL),
        (17, 6, 'Hair/Cosmetics',1,'2021-12-05 23:59:29', '2021-12-05 23:59:29', NULL),
        (18, 6, 'Subscriptions',1,'2021-12-05 23:59:29', '2021-12-05 23:59:29', NULL),
        (19, 7, 'Pet Care',1,'2021-12-05 23:59:29', '2021-12-05 23:59:29', NULL),
        (20, 7, 'Child Care',1,'2021-12-05 23:59:29', '2021-12-05 23:59:29', NULL),
        (21, 7, 'Entertainment',1,'2021-12-05 23:59:29', '2021-12-05 23:59:29', NULL),
        (22, 7, 'Miscellaneous',1,'2021-12-05 23:59:29', '2021-12-05 23:59:29', NULL),
        (23, 8, 'Gym',1,'2021-12-05 23:59:29', '2021-12-05 23:59:29', NULL),
        (24, 8, 'Medicine/Vitamins',1,'2021-12-05 23:59:29', '2021-12-05 23:59:29', NULL),
        (25, 8, 'Doctor Visits',1,'2021-12-05 23:59:29', '2021-12-05 23:59:29', NULL),
        (26, 9, 'Health Insurance',1,'2021-12-05 23:59:29', '2021-12-05 23:59:29', NULL),
        (27, 9, 'Life Insurance',1,'2021-12-05 23:59:29', '2021-12-05 23:59:29', NULL),
        (28, 9, 'Auto Insurance',1,'2021-12-05 23:59:29', '2021-12-05 23:59:29', NULL),
        (29, 9, 'Homeowner/Renter',1,'2021-12-05 23:59:29', '2021-12-05 23:59:29', NULL),
        (30, 9, 'Identity Theft',1,'2021-12-05 23:59:29', '2021-12-05 23:59:29', NULL),
        (31, 10, 'Credit Card',1,'2021-12-05 23:59:29', '2021-12-05 23:59:29', NULL),
        (32, 10, 'Car Payment',1,'2021-12-05 23:59:29', '2021-12-05 23:59:29', NULL),
        (33, 10, 'Student Loan',1,'2021-12-05 23:59:29', '2021-12-05 23:59:29', NULL),
        (34, 10, 'Medical Bill',1,'2021-12-05 23:59:29', '2021-12-05 23:59:29', NULL),
        (35, 10, 'Personal Loan',1,'2021-12-05 23:59:29', '2021-12-05 23:59:29', NULL)");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mst_sub_category');
    }
}
