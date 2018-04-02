<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingSitusesTable extends Migration
{
    public function up()
    {
        Schema::create('setting_situses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('namaSitus');
            $table->string('favicon');
            $table->string('logo');
            $table->string('alamatSitus');
            $table->timestamps();
        });

        DB::table('setting_situses')->insert([
            ['namaSitus' => 'FreeSent', 'favicon' => '/images/favicon.png', 'logo' => '/images/logosimple.png', 'alamatSitus' => 'www.ka01.devku.web.id'],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('setting_situses');
    }
}
