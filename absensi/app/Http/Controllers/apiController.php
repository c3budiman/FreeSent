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
      $range1 = date('Y-m-01', strtotime(Carbon::now()));
      $range2 = date('Y-m-t', strtotime(Carbon::now()));
      $query = daftarPresensi::with('karyawan')->with('manajer')
      ->whereBetween('waktu_absen', array($range1, $range2))
      ->where('id_karyawan','=',Auth::User()->id)->get();
      if ($query == '[]') {
        return response()->json(['error' => 'Rekapan Kosong!'], 404);
      }
      $jumlah = 0;
      foreach ($query as $res) {
        $str_time = $res->durasi_pekerjaan;
        $parsed = date_parse($str_time);
        $seconds = $parsed['hour'] * 3600 + $parsed['minute'] * 60 + $parsed['second'];
        $jumlah = $seconds + $jumlah;
      }
      $hours = floor($jumlah / 3600);
      $minutes = floor(($jumlah / 60) % 60);
      $seconds = $jumlah % 60;

      $total_waktu = "$hours:$minutes:$seconds";
      return Response()->json(['rekap'=>$query, 'total_hours'=>$total_waktu], 200);
    }

    //simple nya logout dengan cara destroy api_token
    public function handleLogout(User $user) {
      $user = $user->find(Auth::User()->id);
      $user->api_token = null;
      $user->save();
      return response()->json(['sukses' => 'Anda Berhasil Logout!'], 200);
    }


    //login absen klo di android....
    public function handlePostPresensi(Request $request) {
      //validasi request id nya
      $this->validate($request, [
        'lokasi_absen'      => 'required',
      ]);
      //get table presensi buat nge cek apa si user udah pernah login apa belom, klo udah suruh dia logout dlu no double absen
      $presensi = DB::table('daftar_presensis')->where('id_karyawan','=',Auth::User()->id)->where('waktu_logout','=',null)->count();
      if ($presensi>0) {
        return response()->json(['error'=>'Silahkan logout terlebih dahulu'],401);
      } else {
        //saya gunakan try biar klo ada yg gagal di proses ini user tak bisa isi absen ATOMISITAS!!!
        try {
          //get id manajer buat nge cek apakah absen sudah dibuka sama si manajernya?
          $id_manajer = DB::table('data_karyawan')->where('id_karyawan','=',Auth::User()->id)->get()->first()->id_manajer;
          if (DB::table('manajer_settings')->where('id_manajer','=',$id_manajer)->get()->first()->buka_absen != "true") {
            return response()->json(['error'=>'Sesi Presensi belum dibuka, silahkan kontak manajer'],401);
          }
          //cek region dari si user di akurin sama region dari si manajer, klo ga di deket si manajer ga bisa absen...
          $region = DB::table('manajer_settings')->where('id_manajer','=',$id_manajer)->get()->first()->lokasi_region;
          $base = "https://maps.googleapis.com/maps/api/geocode/json";
          $key = "AIzaSyBUS0DbuqGat2a2hvg7C1cJYonlVWBN938";
          $url = $base . '?latlng=' . $region . '&key=' . $key;
          $url2 = $base . '?latlng=' . $request->lokasi_absen . '&key=' . $key;
          $regionnya = json_decode(file_get_contents($url));
          $apidecode = json_decode(file_get_contents($url2));
          //kenapa gunain foreach? karena fuck you google map! ga rapi dia naro json nya....
          foreach ($apidecode->results as $fetch) {
            //set ke 0 untuk precise di bangunan, 1 untuk di area sekitar, 2 untuk kota, atau kecamatan
            if ($regionnya->results[2]->formatted_address == $fetch->formatted_address) {
              $id = DB::table('daftar_presensis')->insertGetId(
                  ['id_karyawan'      => Auth::User()->id,
                   'id_manajer'       => $id_manajer,
                   'lokasi_absen'     => $request->lokasi_absen,
                   'lokasi_real'      => $apidecode->results[0]->formatted_address,
                   'lokasi_proximity' => $apidecode->results[2]->formatted_address,
                   'waktu_absen'      => Carbon::now(),
                  ]
              );
              return response()->json(['sukses'=>'Anda Berhasil Mengisi Presensi!','id_presensi'=>$id],201);
            }
          }
          return response()->json(['error'=>'Anda Absen Diluar Region!'],401);
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
      $date1 = $rekapan->waktu_absen;
      $date2 = Carbon::now();
      $diffis = $date2->diffInSeconds($date1);
      $diff = gmdate('H:i:s', $diffis);
      $rekapan->waktu_absen = $date1;
      $rekapan->waktu_logout = $date2;
      $rekapan->durasi_pekerjaan = $diff;
      $rekapan->save();

      //return the report and set it in front end using event
      $range1 = date('Y-m-01', strtotime(Carbon::now()));
      $range2 = date('Y-m-t', strtotime(Carbon::now()));
      $presensi = DB::table('daftar_presensis')->whereBetween('waktu_absen', array($range1, $range2))->where('id_karyawan','=',Auth::User()->id)->where('waktu_logout','<>',null)->get();
      $presensinya = response()->json($presensi);
      $jumlah = 0;
      foreach ($presensi as $res) {
        $str_time = $res->durasi_pekerjaan;
        sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
        $time_seconds = isset($seconds) ? $hours * 3600 + $minutes * 60 + $seconds : $hours * 60 + $minutes;
        $jumlah = $time_seconds + $jumlah;
      }
      $total_waktu = gmdate('H:i:s', $jumlah);
      event(new presensiEvent(Response()->json(['rekap'=>$presensi, 'total_hours'=>$total_waktu], 200)));

      return response()->json(['date1'=>$date1,'date2'=>$date2,'diff'=>$diff]);
    }

    public function getSemuaBerita() {
      $berita = berita::with('authornya.role')->latest()->get();
      return response()->json($berita);
    }

    public function getSettingSitus() {
      $setting = DB::table('setting_situses')->where('id','=','1')->get()->first();
      return response()->json(['data'=>$setting], 200);
    }

}
