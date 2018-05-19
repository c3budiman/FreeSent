<?php

use App\Events\dbEvent;
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



/*
|--------------------------------------------------------------------------
| Guest Roles
|--------------------------------------------------------------------------
|
| Ini route buat yang belom login
|
*/
Route::get('/', 'authController@getRoot');
Route::get('register', 'regisController@getRegis');
Route::post('register', 'regisController@postRegis');
Route::get('login', ['as' => 'login', 'uses' => 'loginController@getlogin']);
Route::post('login', 'loginController@postLogin');
Route::get('logout', 'authController@logout');


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
// Route::get('addsubmenu/withid/{id}', 'WebAdminController@addsubmenu');
Route::put('sidebar/{id}', 'WebAdminController@updateSidebar');
Route::post('addsubmenu', 'WebAdminController@PostAddSubmenu');
Route::post('deletesubmenu', 'WebAdminController@deleteSubmenu');
Route::post('editsubmenu', 'WebAdminController@editsubmenu');
Route::get('logodanfavicon', 'WebAdminController@logoweb');
Route::get('juduldanslogan', 'WebAdminController@judul');
Route::put('juduldanslogan', 'WebAdminController@updateJudulDanSlogan');
//todo setting situses

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


Route::get('karyawan', 'manajerController@getKaryawan');
Route::post('karyawanregistrasi', 'manajerController@postKaryawanBaru');
Route::get('karyawan/json', 'manajerController@karyawanDataTB')->name('karyawan/json');
Route::post('karyawanregistrasiv2', 'manajerController@postKaryawanRegistered');
Route::post('karyawan/delete', 'manajerController@deleteKaryawan');


//Route::get('presensi', 'manajerController@getPresensi');
Route::get('presensi/json', 'manajerController@presensiManajerDataTB')->name('presensi/json');
Route::get('reporting', 'manajerController@getReport');
Route::resource('presensi', 'manajerController');
Route::post('presensi/delete', 'manajerController@DestoyPresensi');
