<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('roles', function (Blueprint $table) {
          $table->increments('id');
          $table->string('name')->unique();
          $table->string('slug')->unique();
          $table->text('params')->nullable();
      });

      Schema::create('roles_users', function (Blueprint $table) {
          $table->integer('roles_id');
          $table->integer('users_id');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
        Schema::dropIfExists('roles_users');
    }
}