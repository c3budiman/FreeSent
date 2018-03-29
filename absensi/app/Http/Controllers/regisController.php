<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\role;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class regisController extends Controller
{
  public function __construct()
  {
      $this->middleware('guest');
  }


  public function getRegis()
  {
    return view('FormRegister');
  }

  public function postRegis()
  {
    $rolesnya = DB::table('roles')->select('id')->where('namaRule', '=', 'AdminWeb')->first()->id;
    $emailexist = DB::table('users')->where('email','=',Input::get('email'))->first();
    if (Input::get('email') == null || Input::get('nama') == null || Input::get('password') == null) {
      return Redirect::back()->withErrors(['Jangan Ada Field yg kosong!']);
    }

    if (!empty($emailexist)) {
      return Redirect::back()->withErrors(['Email sudah digunakan!']);
    } else {
      $user = new User();
      $user->email = strip_tags(Input::get('email'));
      $user->nama = strip_tags(Input::get('nama'));
      $user->avatar = strip_tags(Input::get('avatar'));
      $user->password = bcrypt(Input::get('password'));
      $user->roles_id = $rolesnya;

      $user->save();
      return redirect('/')->with('status', 'Anda Telah berhasil mendaftar!');
    }
  }
}
