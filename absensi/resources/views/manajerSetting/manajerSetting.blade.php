@extends('layouts.dlayout')

@php
  $logo = DB::table('setting_situses')->where('id','=','1')->get()->first()->logo;
@endphp

@section('title')
  Pengaturan Presensi
@endsection

@section('csstambahan')
      <!-- Plugins css-->
    <link href="../plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css" rel="stylesheet" />
    <link href="../plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" />
    <link href="../plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="../plugins/switchery/switchery.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
  <!-- Start Page content -->
  @if (DB::table('manajer_settings')->where('id_manajer','=',Auth::User()->id)->get()->count() > 0)
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card-box table-responsive">
                        <h4 class="m-t-0 header-title">Mengatur Aturan Presensi</h4>
                        <p class="text-muted font-14 m-b-30">
                            Disini kamu bisa mengatur pengaturan presensi seperti mengaktifkan presensi dan mengatur lokasi
                        </p>
                        <form enctype="multipart/form-data" action="{{url(action("manajerController@updateSettingPresensi"))}}" method="post" class="form-horizontal ">
                            {{ csrf_field() }}
                            <div class="form-group row">
                                <label class="col-3 col-form-label">Lat, Long Presensi : </label>
                                <div class="col-9">
                                    <input name="lokasi" type="text" required class="form-control" value="{{DB::table('manajer_settings')->where('id_manajer','=',Auth::User()->id)->get()->first()->lokasi_region}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label"></label>
                                <div class="col-9">
                                    <input disabled type="text" class="form-control" value="{{DB::table('manajer_settings')->where('id_manajer','=',Auth::User()->id)->get()->first()->lokasi_proximity}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">Buka Absen : </label>
                                @if (DB::table('manajer_settings')->where('id_manajer','=',Auth::User()->id)->get()->first()->buka_absen === "true")
                                  <div class="col-9">
                                    <input checked type="radio" name="buka_absen" value="true"> True<br>
                                    <input type="radio" name="buka_absen" value="False"> False<br>
                                  </div>
                                @else
                                  <div class="col-9">
                                    <input type="radio" name="buka_absen" value="true"> True<br>
                                    <input checked type="radio" name="buka_absen" value="False"> False<br>
                                  </div>
                                @endif

                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="pull-right">
                                        <input type="hidden" name="_method" value="PUT">
                                        <button type="submit" name="button" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
  @else
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card-box table-responsive">
                        <h4 class="m-t-0 header-title">Mengatur Aturan Presensi</h4>
                        <p class="text-muted font-14 m-b-30">
                            Disini kamu bisa mengatur pengaturan presensi seperti mengaktifkan presensi dan mengatur lokasi
                        </p>
                        <form enctype="multipart/form-data" action="{{url(action("manajerController@newSettingPresensi"))}}" method="post" class="form-horizontal ">
                            {{ csrf_field() }}
                            <div class="form-group row">
                                <label class="col-3 col-form-label">Lat, Long Presensi : </label>
                                <div class="col-9">
                                    <input name="lokasi" type="text" required class="form-control" value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="pull-right">
                                        <button type="submit" name="button" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
  @endif


@endsection

@section('js')

@endsection
