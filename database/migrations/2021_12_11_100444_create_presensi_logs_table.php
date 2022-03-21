<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresensiLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presensi_logs', function (Blueprint $table) {

            $table->id('id_presensi');

            $table->string('nik');
            $table->foreign('nik')->references('nik')->on('karyawans');

            $table->date('tanggal');

            $table->string('jadwal_kerja');

            $table->double('lat', 11,8)->nullable();
            $table->double('lng', 11,8)->nullable();

            $table->unsignedBigInteger('id_zona');
            $table->foreign('id_zona')->references('id_zona')->on('zonas');

            $table->unsignedBigInteger('id_regu');
            $table->foreign('id_regu')->references('id_regu')->on('regus');

            $table->unsignedBigInteger('id_jabatan');
            $table->foreign('id_jabatan')->references('id_jabatan')->on('jabatans');

            $table->dateTime('check_in')->nullable();

            $table->dateTime('check_out')->nullable();

            $table->enum('status', ['on_duty', 'off_duty']);

            $table->unsignedBigInteger('id_lembur')->nullable();
            $table->foreign('id_lembur')->references('id_lembur')->on('lemburs');

            $table->unsignedBigInteger('id_lembur_khusus')->nullable();
            $table->foreign('id_lembur_khusus')->references('id_lembur_khusus')->on('lembur_khususes');

            $table->unsignedBigInteger('id_absensi')->nullable();
            $table->foreign('id_absensi')->references('id_absensi')->on('absensi_logs');

            $table->string('detail')->nullable();

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
        Schema::dropIfExists('presensi_logs');
    }
}
