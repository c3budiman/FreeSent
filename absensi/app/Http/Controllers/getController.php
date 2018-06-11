<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\daftarPresensi;
use App\berita;

class getController extends Controller
{
    public function getRange($token, $range1, $range2) {
      $users = DB::table('users')->get();
      foreach ($users as $user) {
        if ($user->api_token === $token) {
          $result = daftarPresensi::with('karyawan')
          ->whereBetween('waktu_absen', array($range1, $range2))
          ->where('id_karyawan','=',$user->id)
          ->paginate(10);
          return view('webViewPresensi',['result'=>$result]);
        }
      }
        return 'not found absen';
    }

    public function getRangeView() {
      return view('webViewIndex');
    }

    public function postRangeView(Request $request) {
      $range1 = $request->date1;
      $range2 = $request->date2;
      return redirect("/webview/$token/$range1/$range2");
    }

    public function getBeritaSingle($id) {
      $berita = berita::with('authornya')->where('id_berita','=',$id)->get()->first();
      return view('berita.singleBerita', ['berita'=>$berita]);
    }
}
