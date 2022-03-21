<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanBuktisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_buktis', function (Blueprint $table) {
            $table->id('id_laporan_bukti');

            $table->unsignedBigInteger('id_laporan');
            $table->foreign('id_laporan')->references('id_laporan')->on('laporans');

            $table->string('foto');

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
        Schema::dropIfExists('laporan_buktis');
    }
}
