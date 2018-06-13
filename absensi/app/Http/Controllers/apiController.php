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
use Exception;
use App\Events\presensiEvent;

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
      ]);
      $presensi = DB::table('daftar_presensis')->where('id_karyawan','=',Auth::User()->id)->where('waktu_logout','=',null)->count();
      if ($presensi>0) {
        return response()->json(['error'=>'Silahkan logout terlebih dahulu'],401);
      } else {
        try {
          $id_manajer = DB::table('data_karyawan')->where('id_karyawan','=',Auth::User()->id)->get()->first()->id_manajer;
          $id = DB::table('daftar_presensis')->insertGetId(
              ['id_karyawan'   => Auth::User()->id,
               'id_manajer'    => $id_manajer,
               'lokasi_absen'  => $request->lokasi_absen,
               'waktu_absen'   => Carbon::now()
              ]
          );
          return response()->json(['sukses'=>'Anda Berhasil Mengisi Presensi!','id_presensi'=>$id],201);
        } catch (Exception $e) {
          return response()->json(['tes'=>$e,'error'=>'Anda gagal mengisi karena tidak memiliki manajer, silahkan kontak manajer anda untuk mendaftarkan anda!'],401);
        }
      }
    }

    //this one.... for updating the db after user is log out guys....
    public function handlePostLogoutPresensi(Request $request) {
      $this->validate($request, [
        'id'                => 'required',
      ]);
      $rekapan = daftarPresensi::where('id_tabel','=',$request->id)->get()->first();
      //find the difference between two timestamp....
      $date1 = Carbon::parse($rekapan->waktu_absen);
      $date2 = Carbon::parse(Carbon::now());
      $diffis = $date2->diffInSeconds($date1);
      $diff = gmdate('H:i:s', $diffis);

      $rekapan->waktu_logout = Carbon::now();
      $rekapan->durasi_pekerjaan = $diff;
      $rekapan->save();

      //todo event presensi return exactly report
      $presensi = DB::table('daftar_presensis')->where('id_karyawan','=',Auth::User()->id)->where('waktu_logout','<>',null)->get();
      $presensinya = response()->json($presensi);
      event(new presensiEvent($presensinya));

      return response()->json(['date1'=>$date1,'date2'=>$date2,'diff'=>$diff]);
    }

    public function getSemuaBerita() {
      $berita = berita::with('authornya.role')->latest()->get();
      return response()->json($berita);
    }

    public function getRekapAbsen() {
      $presensi = DB::table('daftar_presensis')->where('id_karyawan','=',Auth::User()->id)->where('waktu_logout','<>',null)->get();
      if ($presensi == '[]') {
        return response()->json(['error'=>'tidak ada presensi']);
      } else {
        return response()->json($presensi);
      }
    }
}
