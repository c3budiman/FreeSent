<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDaftarPresensisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      //untuk daftar presensi dari karyawan
        Schema::create('daftar_presensis', function (Blueprint $table) {
            $table->increments('id_tabel');
            $table->unsignedInteger('id_manajer')->nullable();
            $table->unsignedInteger('id_karyawan')->nullable();
            $table->string('lokasi_absen');
            $table->string('lokasi_real');
            $table->string('lokasi_proximity');
            $table->timestamp('waktu_absen')->nullable();
            $table->timestamp('waktu_logout')->nullable();
            $table->time('durasi_pekerjaan')->nullable();
            $table->timestamps();
        });

        Schema::table('daftar_presensis', function(Blueprint $kolom){
          $kolom->foreign('id_manajer')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
          $kolom->foreign('id_karyawan')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daftar_presensis');
    }
}
