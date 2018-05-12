<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Sidebar;
use App\submenu;
use Excel;
use Datatables;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Transformers\UserTransformer;
use App\SettingSitus;
use App\karyawanList;
use Storage;
use Auth;


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
    $manajer = DB::table('data_karyawan')->where('id_manajer', Auth::User()->id);
    // foreach ($manajer as $mnj) {
    //    $user = DB::table('users')->where('id','=',$mnj->id_karyawan)->get()->first()->email;
    //    echo $user;
    // }
    //$user = DB::table('users')->where('id','=',$manajer->id_karyawan);
    // $user = DB::table('users')->where('name', 'pattern');
    // $model = karyawanList::all();
    //   return Datatables::of($model)
    //         ->addColumn('nama', function (karyawanList $data) {
    //           return $data->karyawannya->map(function($data2) {
    //               return $data2->nama;
    //           })->implode('<br>');
    //         })
    //       ->make(true);
    // $model = karyawanList::with(['karyawannya', 'manajernya'])->get();

    $query = karyawanList::with('karyawannya')->where('id_manajer','=',Auth::User()->id);
    return Datatables::of($query)
    ->addColumn('action', function ($datatb) {
        return
         '<a style="margin-left:5px" href="/karyawan/'.$datatb->id.'/edit" class="btn btn-xs btn-info"><i class="fa fa-edit"></i> Ubah</a>';
    })
    ->make(true);
  }
}
