<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePgContentPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pg_content_pages', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_active')->default(true);
            $table->string('page_name')->nullable();
            $table->timestamps();
        });

        DB::statement("INSERT INTO `pg_content_pages` (`id`, `is_active`, `page_name`,`created_at`, `updated_at`) VALUES
        (1, 1, 'about','2021-12-05 23:59:29', '2021-12-05 23:59:29'),
        (2, 1, 'contact_us','2021-12-05 23:59:29', '2021-12-05 23:59:29')");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pg_content_pages');
    }
}
