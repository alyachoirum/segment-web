<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLembursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lemburs', function (Blueprint $table) {
            $table->id('id_lembur');

            $table->string('nik');
            $table->foreign('nik')->references('nik')->on('karyawans');

            $table->date('tgl_lembur');

            $table->integer('total_jam_lembur');

            $table->string('detail_lembur');

            $table->string('validasi')->nullable();
            $table->foreign('validasi')->references('nik')->on('karyawans');

            $table->string('mengetahui')->nullable();
            $table->foreign('mengetahui')->references('nik')->on('karyawans');

            $table->string('terbit')->default(0);

            $table->string('reject_by')->nullable();
            $table->foreign('reject_by')->references('nik')->on('karyawans');

            $table->string('reject')->nullable();

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
        Schema::dropIfExists('lemburs');
    }
}
