<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Transformers\PenggunaTf;
use App\User;
use App\daftarPresensi;
use App\Events\PresensiDB;
use DB;
use Carbon\Carbon;
use App\berita;

class apiController extends Controller
{

    //login dapat token, dah gitu aja...
    public function handleLoginApi(Request $request, User $user) {
      if(!Auth::attempt(['email'=> $request->email, 'password'=> $request->password])){
        return response()->json(['error' => 'your credential is wrong !'], 401);
      }
      $user = $user->find(Auth::User()->id);
      $user->api_token = bcrypt($user->email.$user->password);
      $user->save();

      return fractal()->item($user)->transformWith(new PenggunaTf)->addMeta(['token' => $user->api_token])->toArray();
    }

    //buat nge get profil user....
    public function handleProfilApi(User $user) {
      $user = $user->find(Auth::User()->id);
      return fractal()->item($user)->transformWith(new PenggunaTf)->toArray();
    }


    //buat nge get rekapan absen si user....
    public function handleRekapan() {
      $query = daftarPresensi::with('karyawan')->with('manajer')->where('id_karyawan','=',Auth::User()->id)->get();
      if ($query == '[]') {
        return response()->json(['error' => 'Rekapan Kosong!'], 404);
      }
      return Response()->json($query, 200);
    }

    //simple nya logout dengan cara destroy api_token
    public function handleLogout(User $user) {
      $user = $user->find(Auth::User()->id);
      $user->api_token = null;
      $user->save();
      return response()->json(['sukses' => 'Anda Berhasil Logout!'], 200);
    }


    //this one..... is reason why i make this app....
    public function handlePostPresensi(Request $request) {
      $this->validate($request, [
        'lokasi_absen'      => 'required',
        'waktu_absen'       => 'required|date',
        'api_token'         => 'required',
      ]);
      $id_karyawan = DB::table('users')->where('api_token','=',$request->token)->get()->first()->id;
      $id = DB::table('daftar_presensis')->insertGetId(
          ['id_karyawan'   => $id_karyawan,
           'id_manajer'    => DB::table('data_karyawan')->where('id_karyawan','=',Auth::User()->id)->get()->first()->id_manajer,
           'lokasi_absen'  => $request->lokasi_absen,
           'waktu_absen'   => $request->waktu_absen
          ]
      );
      // $rekapan = new daftarPresensi;
      // $rekapan->id_karyawan = Auth::User()->id;
      // $rekapan->id_manajer = DB::table('data_karyawan')->where('id_karyawan','=',Auth::User()->id)->get()->first()->id_manajer;
      // $rekapan->lokasi_absen = $request->lokasi_absen;
      // $rekapan->waktu_absen = $request->waktu_absen;
      // $rekapan->save();
      // event(new PresensiDB('Karyawan dengan id '.$rekapan->id_karyawan.' Berhasil Mengisi Presensi'));
      return response()->json(['sukses'=>'Anda Berhasil Mengisi Presensi!','id_presensi'=>$id],201);
    }

    //this one.... for updating the db after user is log out guys....
    public function handlePostLogoutPresensi(Request $request) {
      $this->validate($request, [
        'id'                => 'required',
        'waktu_logout'      => 'required|date',
      ]);
      $rekapan = daftarPresensi::where('id_tabel','=',$request->id)->get()->first();
      //find the difference between two timestamp....
      $date1 = Carbon::parse($rekapan->get()->first()->waktu_absen);
      $date2 = Carbon::parse($request->waktu_logout);
      $diffis = $date2->diffInSeconds($date1);
      $diff = gmdate('H:i:s', $diffis);


      $rekapan->waktu_logout = $request->waktu_logout;
      $rekapan->durasi_pekerjaan = $diff;
      $rekapan->save();
      event(new PresensiDB('Karyawan dengan id '.$rekapan->id_karyawan.' Berhasil Mengisi Presensi'));
      return response()->json(['sukses'=>'Anda Berhasil Logout rekapan anda sudah tercatat!','id_presensi'=>$request->id],201);
    }

    public function getSemuaBerita() {
      $berita = berita::with('authornya.role')->get();
      return response()->json($berita);
    }
}
