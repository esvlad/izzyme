<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      if (!Schema::hasTable('company')) {
        Schema::create('company', function (Blueprint $table) {
            $table->increments('id');
            $table->string('hashtag', 6);
            $table->string('name', 30);
            $table->string('fullname', 50);
            $table->string('address');
            $table->string('ur_address');
            $table->string('phone');
            $table->string('email', 30)->unique();
            $table->string('site', 50);
            $table->string('logotype')->nullable();
            $table->smallInteger('status', 1);
        });
      }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
