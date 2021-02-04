<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('author_id')->unsigned();
            $table->string('title');
            $table->string('slug')->unique();
            $table->boolean('headline')->default(true);
            $table->boolean('selection')->default(false);
            $table->string('video')->nullable();
            $table->string('caption_video')->nullable();
            $table->bigInteger('categorypost_id')->unsigned();
            $table->bigInteger('subcategorypost_id')->unsigned()->nullable();
            $table->bigInteger('setarticle_id')->unsigned()->nullable();
            $table->text('content');
            $table->text('excerpt')->nullable();
            $table->string('image')->nullable();
            $table->string('caption_image')->nullable();
            $table->boolean('status')->default(true);
            $table->boolean('comment_status')->nullable();
            $table->integer('view_count')->default(0);
            $table->bigInteger('updated_by')->nullable();
            $table->bigInteger('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('author_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('categorypost_id')->references('id')->on('categoryposts')->onDelete('restrict');
            $table->foreign('subcategorypost_id')->references('id')->on('subcategoryposts')->onDelete('restrict');
            $table->foreign('setarticle_id')->references('id')->on('setarticles')->onDelete('restrict');

            //create post_tag table
            Schema::create('post_tag', function (Blueprint $table) {
                $table->string('post_id');
                $table->string('tag_id');
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_tag');
        Schema::dropIfExists('posts');
    }
}
