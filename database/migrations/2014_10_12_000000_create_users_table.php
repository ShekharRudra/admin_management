<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('user_type')->default(1)->comment     = '0: Admin, 1: User';
            $table->unsignedBigInteger('plan_id')->nullable();
            $table->string('user_name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('password');
            $table->tinyInteger('is_active')->default(1)->comment     = '0: InActive, 1: Active';
            $table->tinyInteger('is_verified')->default(0)->comment     = '0: Pending, 1: Verified';
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

        });

        DB::table('users')->insert([
            [
                'id'                => 1,
                'user_type'         => 0,
                'plan_id'           => null,
                'user_name'          => 'Admin',
                'first_name'        => 'Admin',
                'last_name'         => 'Admin',
                'email'             => 'admin@gmail.com',
                'password'          => Hash::make('admin@123'),
                'is_active'         => '1',
                'is_verified'         => '1',
            ],
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
