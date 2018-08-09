<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Submenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('submenu', function (Blueprint $table) {
          $table->increments('id');
          $table->unsignedInteger('kepunyaan')->nullable();
          $table->string('nama',100);
          $table->string('link',100);
      });

      Schema::table('submenu', function(Blueprint $kolom){
        $kolom->foreign('kepunyaan')->references('id')->on('dashmenu')->onDelete('cascade')->onUpdate('cascade');
      });

      DB::table('submenu')->insert(
          array(
              'kepunyaan' => 5,
              'nama' => 'Menu Sidebar',
              'link' => '/sidebarsettings'
          )
      );
      DB::table('submenu')->insert(
          array(
              'kepunyaan' => 5,
              'nama' => 'Logo dan Favicon',
              'link' => '/logodanfavicon'
          )
      );
      DB::table('submenu')->insert(
          array(
              'kepunyaan' => 5,
              'nama' => 'Judul dan Slogan',
              'link' => '/juduldanslogan'
          )
      );
      DB::table('submenu')->insert(
          array(
              'kepunyaan' => 8,
              'nama' => 'Tabel Presensi',
              'link' => '/presensi'
          )
      );
      DB::table('submenu')->insert(
          array(
              'kepunyaan' => 8,
              'nama' => 'Presensi By Date',
              'link' => '/presensi/range'
          )
      );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('submenu');
    }
}
