<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLemburKhususesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lembur_khususes', function (Blueprint $table) {
            $table->id('id_lembur_khusus');

            $table->string('nik');
            $table->foreign('nik')->references('nik')->on('karyawans');

            $table->date('tgl_lembur_khusus');

            $table->string('detail_lembur_khusus');

            $table->integer('total_jam_lembur_khusus');

            $table->string('klasifikasi_zona');

            $table->string('validasi')->nullable();
            $table->foreign('validasi')->references('nik')->on('karyawans');

            $table->string('mengetahui')->nullable();
            $table->foreign('mengetahui')->references('nik')->on('karyawans');

            $table->string('approve')->nullable();
            $table->foreign('approve')->references('nik')->on('karyawans');

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
        Schema::dropIfExists('lembur_khususes');
    }
}
