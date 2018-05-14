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
        Schema::create('data_karyawan', function (Blueprint $table) {
            $table->increments('id_tabel');
            $table->unsignedInteger('id_karyawan')->nullable();
            $table->unsignedInteger('id_manajer')->nullable();
        });

        //daftar karyawan, dimana ini nanti banyak banget...
        Schema::table('data_karyawan', function(Blueprint $kolom){
          $kolom->foreign('id_karyawan')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
          $kolom->foreign('id_manajer')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_karyawan');
    }
}
