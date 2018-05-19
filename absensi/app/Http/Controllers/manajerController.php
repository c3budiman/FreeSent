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
    event(new dbEvent('Karyawan '.$request->nama.' Berhasil Ditambahkan'));
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
    event(new dbEvent('Karyawan Berhasil Ditambahkan'));
    return response()->json($response,201);
  }

  public function deleteKaryawan(Request $request) {
    $this->validate($request, [
      'id_tabel'      => 'required',
    ]);
    $karyawan = karyawanList::where('id_tabel', $request->id_tabel)->delete();

    $response = array("success"=>"Sidebar Deleted");
    event(new dbEvent('Karyawan dengan id '.$request->id_tabel.' Berhasil Dihapus'));
    return response()->json($response,200);
  }

  public function getPresensi() {
    return view('presensi.index');
  }

  public function index(presensiDataTable $dataTable)
  {
      return $dataTable->render('presensi.index');
  }

  public function DestoyPresensi(Request $request) {
      $this->validate($request, [
        'id'      => 'required',
      ]);
      $karyawan = daftarPresensi::where('id_tabel', $request->id)->delete();

      $response = array("success"=>"Presensi Deleted");
      return response()->json($response,200);
  }



}
