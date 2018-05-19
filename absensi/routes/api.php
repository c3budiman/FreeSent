<?php

use Illuminate\Http\Request;

Route::post('login','apiController@handleLoginApi');

Route::middleware('auth:api')->group(function () {
  Route::get('profil','apiController@handleProfilApi');
  Route::get('rekap','apiController@handleRekapan');
  Route::get('logout','apiController@handleLogout');
  Route::post('absen','apiController@handlePostPresensi');
  Route::post('logoutabsen','apiController@handlePostLogoutPresensi');
});
