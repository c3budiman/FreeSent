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


class manajerController extends Controller
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

  public function getKaryawan() {
    return view('karyawan.index');
  }

  public function getReport() {
    return view('karyawan.report');
  }

  public function postKaryawanBaru(Request $request, User $user, karyawanList $karyawanList) {
    //validasi request
    $this->validate($request, [
      'nama'      => 'required',
      'email'     => 'required|email|unique:users',
      'password'  => 'required|min:6',
    ]);

    $user = new User();
    $user->email = strip_tags($request->email);
    $user->nama = strip_tags($request->nama);
    $user->avatar = strip_tags($request->avatar);
    $user->password = bcrypt($request->password);
    $user->roles_id = 3;
    $user->save();

    $karyawanList = new karyawanList();
    $karyawanList->id_manajer = Auth::User()->id;
    $karyawanList->id_karyawan = $user->id;
    $karyawanList->save();

    $response = array("success"=>"User Added");
    return response()->json($response,201);
  }


  public function karyawanDataTB() {
    $query = karyawanList::with('karyawannya')->where('id_manajer','=',Auth::User()->id);
    return DataTables::of($query)
    ->addColumn('action', function ($datatb) {
      $id = $datatb->id_tabel;
        return
        '<button data-id="'.$id.'" data-nama="'.$datatb->karyawannya->nama.'" class="delete-modal btn btn-xs btn-danger" type="submit"><i class="fa fa-trash"></i> Delete</button>';
    })
    ->make(true);
  }

  public function postKaryawanRegistered(Request $request) {
    $karyawanList = new karyawanList();
    $karyawanList->id_manajer = Auth::User()->id;
    $karyawanList->id_karyawan = $request->id_user;
    $karyawanList->save();

    $response = array("success"=>"User Added");
    return response()->json($response,201);
  }

  public function deleteKaryawan(Request $request) {
    $this->validate($request, [
      'id_tabel'      => 'required',
    ]);
    $karyawan = karyawanList::where('id_tabel', $request->id_tabel)->delete();

    $response = array("success"=>"Sidebar Deleted");
    return response()->json($response,200);
  }

  public function getPresensi() {
    return view('presensi.index');
  }

  public function presensiManajerDataTB() {
    $query = daftarPresensi::with('karyawan')->where('id_manajer','=',Auth::User()->id);
    return DataTables::of($query)
    ->addColumn('action', function ($datatb) {
      $id = $datatb->id_tabel;
        return
        '<button data-id="'.$id.'" data-nama="'.$datatb->karyawan->nama.'" class="delete-modal btn btn-xs btn-danger" type="submit"><i class="fa fa-trash"></i> Delete</button>';
    })
    ->editColumn('waktu_absen', function ($datatb) {
        return $datatb->waktu_absen ? with(new Carbon($datatb->waktu_absen))->format('d/m/Y h:i:s a') : '';
    })
    ->editColumn('waktu_logout', function ($datatb) {
        return $datatb->waktu_logout ? with(new Carbon($datatb->waktu_logout))->format('d/m/Y h:i:s a') : '';
    })
    ->editColumn('durasi_pekerjaan', function ($datatb) {
      return
      date("h \j\a\m\,\ i \m\\e\\n\\i\\t", strtotime($datatb->durasi_pekerjaan));
    })
    ->addColumn('tgl_keluar', function ($datatb) {
        return
        date("d/m/Y h:i:s a", strtotime($datatb->waktu_logout));
    })

    ->make(true);
  }

  public function index(presensiDataTable $dataTable)
  {
      return $dataTable->render('presensi.presensinya');
  }



}
