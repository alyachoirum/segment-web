<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id('id_user');

            $table->string('nik');
            $table->foreign('nik')->references('nik')->on('karyawans');

            $table->string('email')->nullable();

            $table->string('password');

            $table->unsignedBigInteger('id_level_user');
            $table->foreign('id_level_user')->references('id_level_user')->on('level_users');

            $table->string('foto');

            $table->unsignedBigInteger('id_departemen');
            $table->foreign('id_departemen')->references('id_departemen')->on('departemens');

            $table->timestamp('email_verified_at')->nullable();
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
