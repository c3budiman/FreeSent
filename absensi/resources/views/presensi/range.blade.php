@extends('layouts.dlayout')

@php
  $logo = DB::table('setting_situses')->where('id','=','1')->get()->first()->logo;
@endphp

@section('title')
  Presensi Karyawan Berdasarkan Tanggal
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
  <div class="content">
      <div class="container-fluid">

          <div class="row">
              <div class="col-12">
                  <div class="card-box table-responsive">
                      <h4 class="m-t-0 header-title">Melihat Presensi</h4>
                      <p class="text-muted font-14 m-b-30">
                          Silahkan masukkan dari tanggal berapa ke tanggal berapa anda ingin melihat presensi karyawan anda
                      </p>

                      <form action="{{url(action('manajerController2@postPresensiRange'))}}" method="post">
                      {{-- <form class="" action="" method="get"> --}}
                        {{ csrf_field() }}
                        <div class="form-group row">
                            <label class="col-2 col-form-label">Tanggal Mulai : </label>
                            <div class="col-10">
                                <input class="form-control" type="date" name="date1">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-2 col-form-label">Tanggal Akhir : </label>
                            <div class="col-10">
                                <input class="form-control" type="date" name="date2">
                            </div>
                        </div>

                        <div class="pull-right">
                          <button id="submit" class="btn w-lg btn-rounded btn-primary waves-effect waves-light" type="submit">Cari</button>
                        </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
@endsection

@section('js')
  <script src="../plugins/switchery/switchery.min.js"></script>
  <script src="../plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js"></script>
  <script src="../plugins/select2/js/select2.min.js" type="text/javascript"></script>
  <script src="../plugins/bootstrap-select/js/bootstrap-select.js" type="text/javascript"></script>
  <script src="../plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js" type="text/javascript"></script>
  <script src="../plugins/bootstrap-maxlength/bootstrap-maxlength.js" type="text/javascript"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
  <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>

  <script type="text/javascript">

  </script>

  <!-- Init Js file -->
  <script type="text/javascript" src="assets/pages/jquery.form-advanced.init.js"></script>
@endsection
