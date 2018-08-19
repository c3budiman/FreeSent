<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Sidebar;
use App\submenu;
use Excel;
use DataTables;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Transformers\UserTransformer;
use App\SettingSitus;
use App\karyawanList;
use App\daftarPresensi;
use Storage;
use Auth;
use Carbon\Carbon;
use App\DataTables\presensiDataTable;
use App\Events\dbEvent;
use PDF;

class manajerController2 extends Controller
{
    public function getRoleManajer() {
      $manajer = DB::table('roles')->where('id','=','2')->get()->first()->namaRule;
      return $manajer;
    }

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('rule:'.$this->getRoleManajer().',nothingelse');
    }

    public function range() {
      return view('presensi.range');
    }

    public function postPresensiRange(Request $request) {
      $id_karyawan = $request->id_karyawan;
      $range1 = $request->date1;
      $range2 = $request->date2;
      return redirect("/presensi/range/$range1/$range2/$id_karyawan");
    }

    public function getPresensiByRange($range1, $range2, $id_karyawan){
      if ($id_karyawan == 'all') {
        $result = daftarPresensi::with('karyawan')
        ->whereBetween('waktu_absen', array($range1, $range2))
        ->where('id_manajer','=',Auth::User()->id)
        ->get();
      } else {
        $result = daftarPresensi::with('karyawan')
        ->whereBetween('waktu_absen', array($range1, $range2))
        ->where('id_manajer','=',Auth::User()->id)
        ->where('id_karyawan','=', $id_karyawan)
        ->get();
      }

      return view('presensi.range2',['result'=>$result]);
    }

    public function pdfrekap($range1, $range2, $id_karyawan) {
      if ($id_karyawan == 'all') {
        $nama_for_xls = 'Semua Karyawan';
        $result = daftarPresensi::
        whereBetween('waktu_absen', array($range1, $range2))
        ->where('id_manajer','=',Auth::User()->id)
        ->get()->toArray();
      } else {
        $nama_for_xls = DB::table('users')->where('id','=',$id_karyawan)->get()->first()->nama;
        $result = daftarPresensi::
        whereBetween('waktu_absen', array($range1, $range2))
        ->where('id_manajer','=',Auth::User()->id)
        ->where('id_karyawan','=', $id_karyawan)
        ->get()->toArray();
      }

      $jumlah=0;
      foreach ($result as $res) {
        $str_time = $res['durasi_pekerjaan'];
        sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
        $time_seconds = isset($seconds) ? $hours * 3600 + $minutes * 60 + $seconds : $hours * 60 + $minutes;
        $jumlah = $time_seconds + $jumlah;
      }
      $hours = floor($jumlah / 3600);
      $minutes = floor(($jumlah / 60) % 60);
      $seconds = $jumlah % 60;

      $total_waktu = "$hours:$minutes:$seconds";
      //dd($total_waktu);

      foreach($result as $key => $value){
        $result[$key]['id_manajer'] = DB::table('users')->where('id','=',$result[$key]['id_karyawan'])->get()->first()->email;
        $result[$key]['id_karyawan'] = DB::table('users')->where('id','=',$result[$key]['id_karyawan'])->get()->first()->nama;
        $result[$key]['created_at'] = $total_waktu;
      }

      $result = array_map(function($tag) {
          return array(
              'No. Presensi' => $tag['id_tabel'],
              'Email Karyawan' => $tag['id_manajer'],
              'Nama Karyawan' => $tag['id_karyawan'],
              'Lokasi Absen' => $tag['lokasi_real'],
              'Waktu Absen' => $tag['waktu_absen'],
              'Waktu Logout' => $tag['waktu_logout'],
              'Durasi Pekerjaan' => $tag['durasi_pekerjaan'],
              'Total Durasi Di Laporan Ini' => $tag['created_at']
          );
      }, $result);

      return Excel::create('Laporan rekapan, Total Durasi :  '.$total_waktu." Karyawan : ".$nama_for_xls.' per tgl '.$range1."-".$range2, function($excel) use ($result) {
           $excel->sheet('Laporan Rekapan', function($sheet) use ($result)
           {
               $sheet->fromArray($result);
           });
       })->download('xls');


    }

    public function viewPresensiRange() {

    }
}
