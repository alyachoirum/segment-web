<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsensiLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absensi_logs', function (Blueprint $table) {
            $table->id('id_absensi');

            $table->string('nik');
            $table->foreign('nik')->references('nik')->on('karyawans');

            $table->date('tgl_absen');

            $table->string('tipe_absen');

            $table->string('detail');

            $table->string('bukti')->nullable();

            $table->string('validasi')->nullable();
            $table->foreign('validasi')->references('nik')->on('karyawans');

            $table->string('mengetahui')->nullable();
            $table->foreign('mengetahui')->references('nik')->on('karyawans');

            $table->string('terbit')->nullable();

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
        Schema::dropIfExists('absensi_logs');
    }
}
