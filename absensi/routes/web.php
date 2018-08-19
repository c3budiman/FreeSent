<?php

use App\Events\dbEvent;
use App\berita;
Use Carbon\carbon;
use App\daftarPresensi;
Route::get('tesvue', function () {
    return view('tesvue');
});
Route::get('phpinfo', function () {
    echo phpinfo();
});
Route::get('event', function() {
  event(new dbEvent('hey bro! how are you!'));
});
Route::get('listen', function() {
  return view('tesListen');
});

Route::get('tesbet', function() {
  // $base = "https://maps.googleapis.com/maps/api/geocode/json";
  // $location = "-7.281010,107.812320";
  // $key = "AIzaSyBUS0DbuqGat2a2hvg7C1cJYonlVWBN938";
  // $url = $base . '?latlng=' . $location . '&key=' . $key;
  // $apidecode = json_decode(file_get_contents($url));
  // //dd($apidecode->results[0]->formatted_address);
  // $location2 = "-7.281138,107.813597";
  // $url2 = $base . '?latlng=' . $location2 . '&key=' . $key;
  // $apidecode2 = json_decode(file_get_contents($url2));
  // foreach ($apidecode2->results as $fetch) {
  //   if ($apidecode->results[1]->formatted_address == $fetch->formatted_address) {
  //     echo "Address Oke";
  //   }
  //   echo $fetch->formatted_address;
  //   echo "<br>";
  // }
  // $rekapan = daftarPresensi::where('id_tabel','=','13')->get()->first();
  // //find the difference between two timestamp....
  // $date1 = $rekapan->waktu_absen;
  // $date2 = Carbon::now();
  // $diffis = $date2->diffInSeconds($date1);
  // $diff = gmdate('H:i:s', $diffis);
  // $rekapan->waktu_absen = $date1;
  // $rekapan->waktu_logout = $date2;
  // $rekapan->durasi_pekerjaan = $diff;
  // $str_time = "1:00:00";
  // sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
  // $time_seconds = isset($seconds) ? $hours * 3600 + $minutes * 60 + $seconds : $hours * 60 + $minutes;
  // First day of the month.
  // $range1 = date('Y-m-01', strtotime(Carbon::now()));
  // $range2 = date('Y-m-t', strtotime(Carbon::now()));
  // $query = daftarPresensi::with('karyawan')
  // ->with('manajer')
  // ->whereBetween('waktu_absen', array($range1, $range2))
  // ->where('id_karyawan','=',Auth::User()->id)->get();
  // dd($query);
  $range1 = date('Y-m-01', strtotime(Carbon::now()));
  $range2 = date('Y-m-t', strtotime(Carbon::now()));
  $query = daftarPresensi::with('karyawan')->with('manajer')
  ->whereBetween('waktu_absen', array($range1, $range2))
  ->where('id_karyawan','=',Auth::User()->id)->get();
  if ($query == '[]') {
    return response()->json(['error' => 'Rekapan Kosong!'], 404);
  }
  return Response()->json($query, 200);


});



/*
|--------------------------------------------------------------------------
| User Roles
|--------------------------------------------------------------------------
|
| Ini route buat User Only
|
*/


Route::get('rekap/range/{range1}/{range2}', 'UserController@getPresensiByRange');
Route::post('rekap/range/{range1}/{range2}', 'UserController@postPresensiRange');
Route::get('rekap','UserController@getRekap');
Route::post('rekap', 'UserController@postPresensiRange');



/*
|--------------------------------------------------------------------------
| Auth Roles
|--------------------------------------------------------------------------
|
| Ini route buat yang udah login aja any roles
|
*/
//@auth user
Route::get('myprofile', 'authController@getMyProfile');
Route::get('editprofile', 'authController@getEditProfile');
Route::put('editprofile', 'authController@UpdateProfile');
Route::get('support', 'authController@getSupport');

/*
|--------------------------------------------------------------------------
| Admin Roles
|--------------------------------------------------------------------------
|
| Ini route buat roles admin
|
*/
// Sidebar Part
Route::get('sidebarsettings', 'WebAdminController@getSidebarSetting');
Route::post('addsidebar', 'WebAdminController@tambahSidebarAjax');
Route::get('sidebar/json', 'WebAdminController@sidebarDataTB')->name('sidebar/json');
Route::get('sidebar/{id}/edit', 'WebAdminController@editSidebar');
Route::post('sidebar/delete', 'WebAdminController@deleteSidebar');
Route::get('submenu/json/{id}', 'WebAdminController@submenuDataTB')->name('submenu/json/{id}');
Route::put('sidebar/{id}', 'WebAdminController@updateSidebar');
Route::post('addsubmenu', 'WebAdminController@PostAddSubmenu');
Route::post('deletesubmenu', 'WebAdminController@deleteSubmenu');
Route::post('editsubmenu', 'WebAdminController@editsubmenu');
Route::get('logodanfavicon', 'WebAdminController@logoweb');
Route::get('juduldanslogan', 'WebAdminController@judul');
Route::put('juduldanslogan', 'WebAdminController@updateJudulDanSlogan');

//Berita Part
Route::get('berita', 'WebAdminController@getBerita');
Route::get('berita/json', 'WebAdminController@beritaDataTB')->name('berita/json');
Route::get('tambahBerita', 'WebAdminController@getTambahBerita');
Route::post('berita', 'WebAdminController@postBerita');
Route::post('delete/berita', 'WebAdminController@deleteBerita');
Route::get('berita/{id}/edit','WebAdminController@getBeritaUpdate');
Route::put('berita/{id}/edit', 'WebAdminController@updateBerita');

//User SPA get and ajax part :
Route::get('user/json', 'WebAdminController@userDataTB')->name('user/json');
Route::get('manageuser', 'WebAdminController@manageuser');
Route::post('auth/register','WebAdminController@register');
Route::post('auth/edituser','WebAdminController@edituser');
Route::post('auth/delete','WebAdminController@deleteuser');

//roles
Route::get('roles', 'WebAdminController@getRoles');
Route::get('roles/json', 'WebAdminController@rolesDataTB')->name('roles/json');
Route::post('roles/edit', 'WebAdminController@editRoles');
//
Route::put('logodanfavicon', 'WebAdminController@postImageLogo');

/*
|--------------------------------------------------------------------------
| Manajer Roles
|--------------------------------------------------------------------------
|
| Ini route buat yang udah login aja any roles
|
*/
Route::get('karyawan', 'manajerController@getKaryawan');
Route::post('karyawanregistrasi', 'manajerController@postKaryawanBaru');
Route::get('karyawan/json', 'manajerController@karyawanDataTB')->name('karyawan/json');
Route::post('karyawanregistrasiv2', 'manajerController@postKaryawanRegistered');
Route::post('karyawan/delete', 'manajerController@deleteKaryawan');
Route::get('presensi/range/{range1}/{range2}/{id_karyawan}', 'manajerController2@getPresensiByRange');
Route::post('presensi/range/{range1}/{range2}/{id_karyawan}', 'manajerController2@postPresensiRange');
Route::get('presensi/range','manajerController2@range');
Route::post('presensi/range', 'manajerController2@postPresensiRange');
Route::resource('presensi', 'manajerController');
Route::post('presensi/delete', 'manajerController@DestoyPresensi');
Route::get('settingpresensi', 'manajerController@getSettingPresensi');
Route::post('settingpresensi', 'manajerController@newSettingPresensi');
Route::put('settingpresensi', 'manajerController@updateSettingPresensi');
Route::get('csv/{range1}/{range2}/{id_karyawan}', 'manajerController2@pdfrekap');


/*
|--------------------------------------------------------------------------
| Guest Roles
|--------------------------------------------------------------------------
|
| Ini route buat yang belom login, intinya semua nya bebas bisa akses
|
*/
Route::get('/', 'authController@getRoot');
Route::get('register', 'regisController@getRegis');
Route::post('register', 'regisController@postRegis');
Route::get('login', ['as' => 'login', 'uses' => 'loginController@getlogin']);
Route::post('login', 'loginController@postLogin');
Route::get('logout', 'authController@logout');
Route::get('berita/{id}', 'getController@getBeritaSingle');
