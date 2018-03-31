<?php
Route::get('tesvue', function () {
    return view('tesvue');
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
Route::get('addsidebar', 'WebAdminController@addsidebar');
Route::post('addsidebar', 'WebAdminController@PostAddSidebar');
Route::get('sidebar/json', 'WebAdminController@sidebarDataTB')->name('sidebar/json');
Route::get('sidebar/{id}/edit', 'WebAdminController@editSidebar');
Route::get('user/json', 'WebAdminController@userDataTB')->name('user/json');
Route::get('manageuser', 'WebAdminController@manageuser');
Route::get('submenu/json/{id}', 'WebAdminController@submenuDataTB')->name('submenu/json/{id}');
Route::get('addsubmenu/withid/{id}', 'WebAdminController@addsubmenu');
Route::put('sidebar/{id}', 'WebAdminController@updateSidebar');
Route::get('addsubmenu/withid/{id}', 'WebAdminController@getAddSubMenu');
Route::post('addsubmenu/{id}', 'WebAdminController@PostAddSubmenu');
//todo for sidebar : edit submenu, delete sub menu, delete sidebar, delete


//User SPA ajax part :
Route::post('auth/register','WebAdminController@register');
Route::post('auth/edituser','WebAdminController@edituser');
Route::post('auth/delete','WebAdminController@deleteuser');
