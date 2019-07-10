<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
          $table->increments('id');
          $table->string('hashtag', 6)->unique();
          $table->string('name', 30);
          $table->string('fullname', 50);
          $table->string('address');
          $table->string('ur_address')->nullable();
          $table->string('phone');
          $table->string('email', 30)->unique();
          $table->string('site', 50)->nullable();
          $table->string('logotype')->nullable();
          $table->timestamps();
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
        Schema::dropIfExists('companies');
    }
}
