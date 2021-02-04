<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('tagline')->nullable();
            $table->string('website')->nullable();
            $table->string('email')->unique()->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_key')->nullable();
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
        Schema::dropIfExists('settings');
    }
}
