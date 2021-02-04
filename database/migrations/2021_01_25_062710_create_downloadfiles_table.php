<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDownloadfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('downloadfiles', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('author_id')->unsigned();
            $table->bigInteger('categorydownload_id')->unsigned();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('file')->nullable();
            $table->string('linkfile')->nullable();
            $table->string('embedfile')->nullable();
            $table->string('download_count')->default(0);
            $table->timestamps();
            $table->foreign('author_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('categorydownload_id')->references('id')->on('categorydownloads')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('downloadfiles');
    }
}
