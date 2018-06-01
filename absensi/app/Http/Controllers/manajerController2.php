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

class manajerController2 extends Controller
{
    public function range() {
      return view('presensi.range');
    }

    // public function cariPresensi($range1, $range2) {
    //
    //   return DataTables::of($result)
    //   ->addColumn('action', function ($datatb) {
    //     $id = $datatb->id_tabel;
    //       return
    //       '<button data-id="'.$id.'" data-nama="'.$datatb->karyawan->nama.'" class="delete-modal btn btn-xs btn-danger" type="submit"><i class="fa fa-trash"></i> Delete</button>';
    //   })
    //   ->editColumn('waktu_absen', function ($datatb) {
    //       return $datatb->waktu_absen ? with(new Carbon($datatb->waktu_absen))->format('d/m/Y h:i:s a') : '';
    //   })
    //   ->editColumn('waktu_logout', function ($datatb) {
    //     if ($datatb->waktu_logout != "") {
    //       return $datatb->waktu_logout ? with(new Carbon($datatb->waktu_logout))->format('d/m/Y h:i:s a') : '';
    //     } else {
    //       return "Belum Logout";
    //     }
    //   })
    //   ->editColumn('durasi_pekerjaan', function ($datatb) {
    //     if ($datatb->durasi_pekerjaan != "") {
    //       return
    //       date("h \j\a\m\,\ i \m\\e\\n\\i\\t", strtotime($datatb->durasi_pekerjaan));
    //     } else {
    //       return "Belum Logout";
    //     }
    //   });
    // }

    public function postPresensiRange(Request $request) {
      $range1 = $request->date1;
      $range2 = $request->date2;
      return redirect("/presensi/range/$range1/$range2");
    }

    public function getPresensiByRange($range1, $range2){
      $result = daftarPresensi::with('karyawan')
      ->whereBetween('waktu_absen', array($range1, $range2))
      ->where('id_manajer','=',Auth::User()->id)
      ->paginate(10);

      return view('presensi.range2',['result'=>$result]);
    }

    public function viewPresensiRange() {

    }
}
