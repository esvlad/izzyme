<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stories', function (Blueprint $table) {
            $table->increments('id');
            $table->datetime('date_add');
            $table->tinyInteger('comments')->unsigned()->nullable();
            $table->smallInteger('likes')->unsigned()->nullable();
            $table->tinyInteger('reposts')->unsigned()->nullable();
            $table->integer('views')->default(0);
            $table->text('attachments')->nullable();
            $table->mediumText('data')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stories');
    }
}
