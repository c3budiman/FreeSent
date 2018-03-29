<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Sidebar;
use Excel;
use Datatables;
use App\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class WebAdminController extends Controller
{
    public function getRoleAdmin() {
      $rolesyangberhak = DB::table('roles')->where('id','=','1')->get()->first()->namaRule;
      return $rolesyangberhak;
    }

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('rule:'.$this->getRoleAdmin().',nothingelse');
    }

    public function getSidebarSetting() {
      return view('sidebar.index');
    }

    public function sidebarDataTB() {
      return Datatables::of(Sidebar::query())
            ->addColumn('kepunyaan_roles', function($datatb) {
              return DB::table('roles')->where('id','=',$datatb->kepunyaan)->get()->first()->namaRule;
            })
            ->addColumn('action', function ($datatb) {
                return
                 '<a style="margin-left:5px" href="/sidebar/'.$datatb->id.'/edit" class="btn btn-xs btn-info"><i class="fa fa-edit"></i> Ubah</a>'
                .'<a style="margin-left:5px" href="/sidebar/'.$datatb->id.'/delete" class="btn btn-xs btn-danger"><i class="fa fa-minus"></i> Hapus</a>';
            })
            ->make(true);
    }

    public function addsidebar() {
      return view('sidebar.tambahsidebar');
    }

    public function PostAddSidebar(Request $request) {
      $sidebar = new Sidebar();
      $sidebar->nama = strip_tags(Input::get('nama'));
      $sidebar->kepunyaan = strip_tags(Input::get('roles_id'));
      $sidebar->class_css = strip_tags(Input::get('class_css'));
      $sidebar->link = strip_tags(Input::get('link'));
      $sidebar->save();
      return redirect('/')->with('status', 'telah berhasil di daftarkan!');
    }

    public function editSidebar($id) {
      $sidebar = Sidebar::find($id);
      if (!$sidebar) {
        abort(404);
      }
      return view('sidebar.editsidebar', ['sidebar'=>$sidebar, 'id'=>$id]);
    }

    public function submenuDataTB($id)
    {
      $submenu = DB::table('submenu')->where('kepunyaan', $id);
        return Datatables::of($submenu)
            ->addColumn('action', function ($datatb) {
                return
                '<a class="btn btn-info" href="/submenu/'.$datatb->id.'/edit"><i class="fa fa-edit"></i> Ubah </a>'
                .'<a style="margin-left:5px" class="btn btn-danger" href="/submenu/'.$datatb->id.'/delete"> <i class="fa fa-minus"></i> Delete </a>' ;
            })
            ->make(true);
    }

    public function userDataTB() {
      return Datatables::of(User::query())
            ->addColumn('action', function ($datatb) {
                return
                 '<a style="margin-left:5px" href="/pengguna/'.$datatb->id.'/edit" class="btn btn-xs btn-info"><i class="glyphicon glyphicon-edit"></i> Ubah</a>'
                .'<a style="margin-left:5px" href="/pengguna/'.$datatb->id.'/delete" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-minus"></i> Hapus</a>';
            })
            ->make(true);
    }

    public function manageuser() {
      return view('user.userIndex');
    }


}
