<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('author_id')->unsigned();
            $table->string('title');
            $table->string('slug')->unique();
            $table->bigInteger('categorypage_id')->unsigned();
            $table->text('content');
            $table->text('excerpt');
            $table->string('image')->nullable();
            $table->string('caption_image')->nullable();
            $table->string('video')->nullable();
            $table->string('caption_video')->nullable();
            $table->boolean('status');
            $table->integer('view_count')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('author_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('categorypage_id')->references('id')->on('categorypages')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
}
