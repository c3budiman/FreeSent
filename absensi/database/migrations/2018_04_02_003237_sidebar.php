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
          $table->string('class_css');
          $table->string('nama');
          $table->string('link');
      });

      Schema::table('dashmenu', function(Blueprint $kolom){
        $kolom->foreign('kepunyaan')->references('id')->on('roles')->onDelete('cascade')->onUpdate('cascade');
      });

      Schema::create('submenu', function (Blueprint $table) {
          $table->increments('id');
          $table->unsignedInteger('kepunyaan')->nullable();
          $table->string('nama');
          $table->string('link');
      });

      Schema::table('submenu', function(Blueprint $kolom){
        $kolom->foreign('dashmenu')->references('id')->on('dashmenu')->onDelete('cascade')->onUpdate('cascade');
      });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dashmenu');
        Schema::dropIfExists('submenu');
    }
}
