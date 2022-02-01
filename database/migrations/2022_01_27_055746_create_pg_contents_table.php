<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePgContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pg_contents', function (Blueprint $table) {
            $table->id();
            $table->string('tag_name')->nullable();
            $table->string('page_name')->nullable();
            $table->integer('sequence_no')->nullable();
            $table->string('side')->nullable();
            $table->string('type')->nullable()->comment = 'image: image, description: description, other:other';
            $table->string('image')->nullable();
            $table->longText('description')->nullable();
            $table->boolean('is_active')->default(true);
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
        Schema::dropIfExists('pg_contents');
    }
}
