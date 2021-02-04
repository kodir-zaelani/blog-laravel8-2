<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('socials', function (Blueprint $table) {
            $table->id();
            $table->string('facebook')->nullable();
            $table->text('facebook_embed')->nullable();
            $table->string('instagram')->nullable();
            $table->text('instagram_embed')->nullable();
            $table->string('youtube')->nullable();
            $table->text('youtube_embed')->nullable();
            $table->string('twitter')->nullable();
            $table->string('twitter_embed')->nullable();
            $table->string('whatapps')->nullable();
            $table->string('telegram')->nullable();
            $table->string('pinterest')->nullable();
            $table->text('pinterest_embed')->nullable();
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
        Schema::dropIfExists('socials');
    }
}
