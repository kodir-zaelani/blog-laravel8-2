<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWidgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('widgets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('author_id')->unsigned(); 
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('fontawesome')->nullable();
            $table->text('source')->nullable();
            $table->string('position');
            $table->boolean('status')->default(true);
            $table->timestamps();
            
            $table->foreign('author_id')->references('id')->on('users')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('widgets');
    }
}
