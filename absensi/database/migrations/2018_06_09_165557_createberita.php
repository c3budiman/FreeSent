<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Createberita extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('berita', function (Blueprint $table) {
          $table->increments('id_berita');
          $table->unsignedInteger('author')->nullable();
          $table->string('uri',100);
          $table->string('judul',100);
          $table->text('content');
          $table->timestamps();
      });

      Schema::table('berita', function(Blueprint $kolom){
        $kolom->foreign('author')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('berita');
    }
}
