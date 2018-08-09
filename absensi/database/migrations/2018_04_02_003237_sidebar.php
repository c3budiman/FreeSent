<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Sidebar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('dashmenu', function (Blueprint $table) {
          $table->increments('id');
          $table->unsignedInteger('kepunyaan')->nullable();
          $table->string('class_css',60);
          $table->string('nama',100);
          $table->string('link',100);
      });

      Schema::table('dashmenu', function(Blueprint $kolom){
        $kolom->foreign('kepunyaan')->references('id')->on('roles')->onDelete('cascade')->onUpdate('cascade');
      });

      DB::table('dashmenu')->insert([
          ['kepunyaan' => 1, 'class_css' => 'dripicons-home', 'nama' => 'Home', 'link' => '/'],
          ['kepunyaan' => 1, 'class_css' => 'dripicons-lock', 'nama' => 'Roles', 'link' => '/roles'],
          ['kepunyaan' => 1, 'class_css' => 'dripicons-user-group', 'nama' => 'Pengguna', 'link' => '/manageuser'],
          ['kepunyaan' => 1, 'class_css' => 'dripicons-device-mobile', 'nama' => 'Berita', 'link' => '/berita'],
          ['kepunyaan' => 1, 'class_css' => 'dripicons-device-desktop', 'nama' => 'Website', 'link' => '/manageweb'],
          ['kepunyaan' => 2, 'class_css' => 'dripicons-home', 'nama' => 'Home', 'link' => '/'],
          ['kepunyaan' => 2, 'class_css' => 'dripicons-user-group', 'nama' => 'Karyawan', 'link' => '/karyawan'],
          ['kepunyaan' => 2, 'class_css' => 'fa fa-address-card-o', 'nama' => 'Tabel Presensi', 'link' => '/presensi'],
          ['kepunyaan' => 2, 'class_css' => 'fa fa-gear', 'nama' => 'Setting Presensi', 'link' => '/settingpresensi'],
          ['kepunyaan' => 3, 'class_css' => 'dripicons-home', 'nama' => 'Home', 'link' => '/'],
          ['kepunyaan' => 3, 'class_css' => 'fa fa-address-card-o', 'nama' => 'Rekap Presensi', 'link' => '/rekap']
      ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dashmenu');
    }
}
