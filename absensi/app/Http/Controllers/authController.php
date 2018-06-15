<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Redirect;
use File;
use Storage;
use User;
use App\Sidebar;
use Excel;
use Datatables;
use Illuminate\Support\Facades\Input;

class authController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');
  }

  public function logout() {
    Auth::logout();
    return redirect('/login')->with('status', 'Anda Telah berhasil logout!');
  }

  public function getRoot() {
    if (Auth::User()->roles_id == 1) {
      return view('dashboard.DashAdmin');
    } elseif (Auth::User()->roles_id == 2) {
      return view('dashboard.DashManajer');
    } else {
      return view('dashboard.DashUser');
    }
  }

  public function getMyProfile() {
    return view('myProfile');
  }

  public function getEditProfile() {
    return view('editprofile');
  }

  public function getSupport() {
    return view('support');
  }

  public function UpdateProfile(Request $request) {
    if ($request->hasFile('tes')) {
      $namafile = $request->file('tes')->getClientOriginalName();
      $ext = $request->file('tes')->getClientOriginalExtension();
      $newNamaFile = Auth::User()->email .'-id_'. Auth::User()->id . '.' .$ext;
      $lokasifileskr = '/storage/avatar/'.$newNamaFile;
      // cek jika file sudah ada...
      if(Storage::has("public/avatar/".$namafile)) {
        $file_lama = str_replace("storage","public",Auth::User()->avatar);
        Storage::delete($file_lama);
        return Redirect::back()->withErrors(['File sudah ada, Kok bisa gituh sih? tar saya delete dlu... silahkan coba upload lagi!']);
      }
      // yg paling penting cek extension, no php allowed
      if ($ext == "png" || $ext == "jpg") {
        //store
        $destinasi = public_path('storage/avatar/');
        $proses = $request->file('tes')->move($destinasi,$newNamaFile);
        //delete foto sebelumnya jika ada....
        if (Auth::User()->avatar != null || Auth::User()->avatar != "") {
          $file_lama = str_replace("storage","public",Auth::User()->avatar);
          Storage::delete($file_lama);
        }

        //update db
        $users = Auth::user();
        $users->email = strip_tags(Input::get('email'));
        $users->nama = strip_tags(Input::get('nama'));
        $users->avatar = $lokasifileskr;
        $users->save();
        return redirect('editprofile')->with('status', 'Profil Berhasil Di Update!');
      } else {
        return Redirect::back()->withErrors(['format file salah, tidak bisa diupload']);
      }
    } else {
      //update db without poto profile
      //update db
      $users = Auth::user();
      $users->email = strip_tags(Input::get('email'));
      $users->nama = strip_tags(Input::get('nama'));
      $users->save();
      return redirect('editprofile')->with('status', 'Profil Berhasil Di Update!');
    }
  }

}
