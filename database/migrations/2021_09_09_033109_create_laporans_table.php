<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporans', function (Blueprint $table) {
            $table->id('id_laporan');

            $table->string('nik');
            $table->foreign('nik')->references('nik')->on('karyawans');

            $table->unsignedBigInteger('id_departemen');
            $table->foreign('id_departemen')->references('id_departemen')->on('departemens');

            $table->string('judul_laporan');

            $table->unsignedBigInteger('id_kategori');
            $table->foreign('id_kategori')->references('id_kategori')->on('kategoris');

            $table->enum('prioritas', ['Normal','Medium','High','Urgent']);
            $table->enum('tingkat', ['1','2','3','4']);

            $table->string('appv1')->nullable();
            $table->foreign('appv1')->references('nik')->on('karyawans');

            $table->string('appv2')->nullable();
            $table->foreign('appv2')->references('nik')->on('karyawans');

            $table->string('appv3')->nullable();
            $table->foreign('appv3')->references('nik')->on('karyawans');

            $table->tinyInteger('publish')->default(0);

            $table->double('lat', 11,8);
            $table->double('lng', 11,8);

            $table->unsignedBigInteger('id_zona');
            $table->foreign('id_zona')->references('id_zona')->on('zonas');

            $table->string('unit_kerja');
            $table->dateTime('tgl_waktu_kejadian');
            $table->string('kronologi_kejadian');
            $table->string('akibat_kejadian');
            $table->string('bantuan_pengamanan');

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
        Schema::dropIfExists('laporans');
    }
}
