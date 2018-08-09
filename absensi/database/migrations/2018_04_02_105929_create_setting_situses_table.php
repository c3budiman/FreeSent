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
            $table->string('namaSitus',50);
            $table->string('slogan',100);
            $table->string('favicon',100);
            $table->string('logo',100);
            $table->string('alamatSitus',60);
            $table->timestamps();
        });

        DB::table('setting_situses')->insert([
            ['namaSitus' => 'FreeSent', 'slogan' => 'Kemudahan Absen, kini bisa dilakukan secara daring melalui segala jenis perangkat.' , 'favicon' => '/images/favicon.png', 'logo' => '/images/logofreesentsimple.png', 'alamatSitus' => 'www.ka01.devku.web.id'],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('setting_situses');
    }
}
