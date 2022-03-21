<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTukarShiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tukar_shifts', function (Blueprint $table) {
            $table->id('id_tukar_shift');

            $table->dateTime('tgl_tukar');

            $table->string('nik_pihak1');
            $table->foreign('nik_pihak1')->references('nik')->on('karyawans');

            $table->string('nik_pihak2');
            $table->foreign('nik_pihak2')->references('nik')->on('karyawans');

            $table->string('nik_kajaga_pihak1');
            $table->foreign('nik_kajaga_pihak1')->references('nik')->on('karyawans');

            $table->string('nik_kajaga_pihak2');
            $table->foreign('nik_kajaga_pihak2')->references('nik')->on('karyawans');

            $table->string('awal_jam_kerja');

            $table->string('ubah_jam_kerja');

            $table->string('apv_pihak2')->nullable();
            $table->foreign('apv_pihak2')->references('nik')->on('karyawans');

            $table->string('apv_kajaga_p1')->nullable();
            $table->foreign('apv_kajaga_p1')->references('nik')->on('karyawans');

            $table->string('apv_kajaga_p2')->nullable();
            $table->foreign('apv_kajaga_p2')->references('nik')->on('karyawans');

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
        Schema::dropIfExists('tukar_shifts');
    }
}
