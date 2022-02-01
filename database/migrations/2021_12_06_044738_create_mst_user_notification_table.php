<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstUserNotificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_user_notification', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            // $table->unsignedBigInteger('art_id');
            $table->string('notification_icon')->nullable();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->tinyInteger('is_read')->default(0)->comment     = '1: Read, 0: Unread';
            $table->integer('screen_no')->nullable();
            $table->integer('is_redirect')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
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
        Schema::dropIfExists('mst_user_notification');
    }
}
