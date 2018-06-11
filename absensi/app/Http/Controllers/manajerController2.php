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
