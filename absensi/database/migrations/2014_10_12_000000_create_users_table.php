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
            $table->string('nama',100);
            $table->string('email',100)->unique();
            $table->unsignedInteger('roles_id')->nullable();
            $table->string('avatar',100);
            $table->string('password');
            $table->string('api_token')->nullable();
            $table->rememberToken()->nullable();
            $table->timestamps();
        });

        Schema::create('roles', function(Blueprint $kolom) {
          $kolom->increments('id');
          $kolom->string('namaRule',50);
        });

        Schema::table('users', function(Blueprint $kolom){
          $kolom->foreign('roles_id')->references('id')->on('roles')->onDelete('cascade')->onUpdate('cascade');
        });

        DB::table('roles')->insert(
          ['id' => 1, 'namaRule' => 'Admin']
        );
        DB::table('roles')->insert(
          ['id' => 2, 'namaRule' => 'Manajer']
        );
        DB::table('roles')->insert(
          ['id' => 3, 'namaRule' => 'Pengguna']
        );

        DB::table('users')->insert(
            array(
                'nama' => 'Cecep Budiman',
                'email' => 'c3budiman@gmail.com',
                'roles_id' => 1,
                'avatar' => '/images/avatar.png',
                'password' => '$2y$10$wPiZJWRSRQNs.miLWWSJfu7NiN3KUJzeXD316i9xynnCWigJjY1/q',
                'api_token' => ''
            )
        );

        DB::table('users')->insert(
            array(
                'nama' => 'Manajer',
                'email' => 'tesmanajer@gmail.com',
                'roles_id' => 2,
                'avatar' => '/images/avatar.png',
                'password' => '$2y$10$gZFgFXNoBGFOZloaXT/SguF39RTgzLMMiBm68/GTysFJ4ajQmk9vy',
                'api_token' => '',
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
        Schema::dropIfExists('users');
        Schema::dropIfExists('roles');
    }
}
