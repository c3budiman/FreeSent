<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;


class PenggunaController extends Controller
{

  public function RegisterPengguna() {
    return view('FormRegister');
  }

  public function LoginPengguna() {
    return view('FormLogin');
  }

  public function postLogin() {

  }


}
