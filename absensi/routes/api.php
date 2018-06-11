<?php

use Illuminate\Http\Request;

Route::post('login','apiController@handleLoginApi');
Route::get('tes', function () {
  return response()->json(['sukses' => 'Berhasil Akses!'], 200);
});

Route::middleware('auth:api')->group(function () {
  Route::get('profil','apiController@handleProfilApi');
  Route::get('rekap','apiController@handleRekapan');
  Route::get('logout','apiController@handleLogout');
  Route::post('absen','apiController@handlePostPresensi');
  Route::post('logoutabsen','apiController@handlePostLogoutPresensi');
  Route::get('berita', 'apiController@getSemuaBerita');
});
Route::get('berita', 'apiController@getSemuaBerita');
