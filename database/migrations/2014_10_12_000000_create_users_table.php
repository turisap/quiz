<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->boolean('student')->default(1);
            $table->boolean('teacher')->default(0);
            $table->boolean('admin')->default(0);
            $table->boolean('premium')->default(0);
            $table->string('school')->nullable()->default(NULL);
            $table->string('grade')->nullable()->default(NULL);
            $table->integer('age')->nullable()->default(NULL);
            $table->string('favorite_subject')->nullable()->default(NULL);
            $table->boolean('gender')->nullable()->default(NULL);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
