<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalShiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal_shifts', function (Blueprint $table) {

            $table->id('id_jadwal');

            $table->integer('tanggal');
            $table->integer('bulan');
            $table->integer('tahun');

            $table->string('regu');

            $table->integer('pattern_number');

            $table->Time('jam_masuk');
            $table->Time('jam_keluar');
            $table->string('action');

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
        Schema::dropIfExists('jadwal_shifts');
    }
}
