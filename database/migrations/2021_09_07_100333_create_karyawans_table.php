<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKaryawansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('karyawans', function (Blueprint $table) {

            $table->id('id_karyawan');

            $table->string('nik')->unique();

            $table->string('nama_lengkap');

            $table->unsignedBigInteger('id_zona');
            $table->foreign('id_zona')->references('id_zona')->on('zonas');

            $table->unsignedBigInteger('id_regu');
            $table->foreign('id_regu')->references('id_regu')->on('regus');

            $table->unsignedBigInteger('id_jabatan');
            $table->foreign('id_jabatan')->references('id_jabatan')->on('jabatans');

            $table->string('pt');

            $table->string('no_kib')->nullable();

            $table->date('tgl_lahir');

            $table->string('alamat')->nullable();

            $table->string('rtrw')->nullable();

            $table->string('desa')->nullable();

            $table->string('kecamatan')->nullable();

            $table->string('kabupaten')->nullable();

            $table->string('no_hp')->nullable();

            $table->string('no_ktp')->nullable();

            $table->string('kompetensi_gada')->nullable();

            $table->string('no_reg')->nullable();

            $table->string('no_kta')->nullable();

            $table->string('no_ijazah')->nullable();

            $table->date('tgl_jatuhtempo_gada')->nullable();

            $table->integer('sisa_cuti');

            $table->integer('status_aktif');

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
        Schema::dropIfExists('karyawans');
    }
}
