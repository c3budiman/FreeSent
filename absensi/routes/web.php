<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('tesvue', function () {
    return view('tesvue');
});

Route::get('/', 'authController@getRoot');
Route::get('register', 'regisController@getRegis');
Route::post('register', 'regisController@postRegis');
Route::get('login', ['as' => 'login', 'uses' => 'loginController@getlogin']);
Route::post('login', 'loginController@postLogin');
Route::get('logout', 'authController@logout');

//@auth user
Route::get('myprofile', 'authController@getMyProfile');
Route::get('editprofile', 'authController@getEditProfile');
Route::put('editprofile', 'authController@UpdateProfile');

//@webadmin
Route::get('sidebarsettings', 'WebAdminController@getSidebarSetting');
Route::get('addsidebar', 'WebAdminController@addsidebar');
Route::post('addsidebar', 'WebAdminController@PostAddSidebar');
Route::get('sidebar/json', 'WebAdminController@sidebarDataTB')->name('sidebar/json');
Route::get('sidebar/{id}/edit', 'WebAdminController@editSidebar');
Route::get('user/json', 'WebAdminController@userDataTB')->name('user/json');
Route::get('manageuser', 'WebAdminController@manageuser');
Route::get('submenu/json/{id}', 'WebAdminController@submenuDataTB')->name('submenu/json/{id}');
Route::get('addsubmenu/withid/{id}', 'WebAdminController@addsubmenu');
