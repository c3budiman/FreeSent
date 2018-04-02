<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->string('email')->unique();
            $table->unsignedInteger('roles_id')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('roles', function(Blueprint $kolom) {
          $kolom->increments('id');
          $kolom->string('namaRule');
        });

        Schema::table('users', function(Blueprint $kolom){
          $kolom->foreign('roles_id')->references('id')->on('roles')->onDelete('cascade')->onUpdate('cascade');
        });


        DB::table('roles')->insert(
            array(
                'namaRule' => 'Admin',
            )
        );

        DB::table('users')->insert(
            array(
                'nama' => 'Cecep Budiman',
                'email' => 'c3budiman@gmail.com',
                'roles_id' => 1,
                'password' => '$2y$10$wPiZJWRSRQNs.miLWWSJfu7NiN3KUJzeXD316i9xynnCWigJjY1/q'
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
        Schema::dropIfExists('dashmenu');
        Schema::dropIfExists('submenu');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('users');
    }
}
