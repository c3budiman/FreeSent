<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKaryawanListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manajer', function (Blueprint $table) {
            $table->unsignedInteger('id_manajer')->nullable();
            $table->string('nama_manajer');
        });

        Schema::create('karyawan', function (Blueprint $table) {
            $table->unsignedInteger('id_karyawan')->nullable();
            $table->unsignedInteger('id_manajer')->nullable();
            $table->string('nama_karyawan');
        });

        //untuk daftar karyawan, dimana manajer bisa menambahkan karyawan
        Schema::table('manajer', function(Blueprint $kolom){
          $kolom->foreign('id_manajer')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

        //daftar karyawan, dimana ini nanti banyak banget... saya referensikan dari daftar manajer agar lebih ternormalisasi
        Schema::table('karyawan', function(Blueprint $kolom){
          $kolom->foreign('id_karyawan')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
          $kolom->foreign('id_manajer')->references('id_manajer')->on('manajer')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('karyawan');
        Schema::dropIfExists('manajer');
    }
}
