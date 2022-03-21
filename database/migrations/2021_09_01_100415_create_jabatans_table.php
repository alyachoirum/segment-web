<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJabatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jabatans', function (Blueprint $table) {
            $table->id('id_jabatan');

            $table->string('nama_jabatan');

            $table->unsignedBigInteger('id_zona');
            $table->foreign('id_zona')->references('id_zona')->on('zonas');

            $table->unsignedBigInteger('id_regu');
            $table->foreign('id_regu')->references('id_regu')->on('regus');

            $table->integer('direct_jab_atasan');

            $table->integer('direct_jab_atasan_2');

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
        Schema::dropIfExists('jabatans');
    }
}
