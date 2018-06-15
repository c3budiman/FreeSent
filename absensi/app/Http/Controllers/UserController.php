<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\daftarPresensi;

class UserController extends Controller
{
  public function getRoleUser() {
    $rolesyangberhak = DB::table('roles')->where('id','=','3')->get()->first()->namaRule;
    return $rolesyangberhak;
  }

  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('rule:'.$this->getRoleUser().',nothingelse');
  }

  public function getRekap() {
    return view('rolePengguna.rekap');
  }

  public function postPresensiRange(Request $request) {
    $range1 = $request->date1;
    $range2 = $request->date2;
    return redirect("/rekap/range/$range1/$range2");
  }

  public function getPresensiByRange($range1, $range2){
    $result = daftarPresensi::with('karyawan')
    ->whereBetween('waktu_absen', array($range1, $range2))
    ->where('id_karyawan','=',Auth::User()->id)
    ->paginate(10);

    return view('rolePengguna.rekap2',['result'=>$result]);
  }


}
