<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManajerSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manajer_settings', function (Blueprint $table) {
            $table->increments('id_tabel');
            $table->unsignedInteger('id_manajer')->nullable();
            $table->string('lokasi_region',100);
            $table->string('lokasi_proximity',100);
            $table->string('buka_absen',50);
            $table->timestamps();
        });

        Schema::table('manajer_settings', function(Blueprint $kolom){
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
        Schema::dropIfExists('manajer_settings');
    }
}
