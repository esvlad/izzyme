<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
          $table->increments('id');
          $table->string('link');
          $table->string('image')->nullable();
          $table->bigInteger('unixtime')->unsigned();
          $table->dateTime('date_add');
          $table->dateTime('date_update')->nullable();
          $table->dateTime('date_end')->nullable();
          $table->mediumText('data')->nullable();
          $table->integer('view')->unsigned()->default(0);
          $table->tinyInteger('status');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post');
    }
}
