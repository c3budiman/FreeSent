@extends('layouts.dlayout')

@php
  $logo = DB::table('setting_situses')->where('id','=','1')->get()->first()->logo;
@endphp

@section('title')
  Presensi Karyawan Berdasarkan Tanggal | {{ Request::segment(3) }} - {{ Request::segment(4) }}
@endsection

@section('csstambahan')
      <!-- Plugins css-->
    <script type="text/JavaScript" src="/print.js"> </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
  <style media="screen">
    .element::-webkit-scrollbar { width: 0 !important }
  </style>
  <!-- Start Page content -->
  <div id="Print" class="content">
      <div class="container-fluid">
          <div class="row">
              <div class="col-12">
                  <div class="card-box table-responsive">
                    @if ($result->count() > 0)
                      <h4 class="m-t-0 header-title">Hasil Pencarian Range Presensi Per tanggal : {{ Request::segment(3) }} s/d {{ Request::segment(4) }}</h4>

                      <div class="form-group row">
                        <table style="width:100%;" border="1px" id="contoh" class="table table-bordered table-hover datatable">
                          <thead>
                            <tr>
                              <th> Id</th>
                              <th >Email</th>
                              <th >Nama</th>
                              <th >Lokasi Absen</th>
                              <th >Waktu Absen</th>
                              <th >Waktu Logout</th>
                              <th >Durasi Pekerjaan</th>
                            </tr>
                          </thead>

                            @foreach ($result as $res)
                                <tr>
                                  <td>{{$res->id_tabel}}</td>
                                  <td>{{$res->karyawan->email}}</td>
                                  <td>{{$res->karyawan->nama}}</td>
                                  <td>{{$res->lokasi_real}}</td>
                                  <td>{{$res->waktu_absen}}</td>
                                  <td>{{$res->waktu_logout}}</td>
                                  <td>{{$res->durasi_pekerjaan}}</td>
                                </tr>
                              @endforeach
                          </table>

                      </div>
                      <div class="form-group row">
                          <label class="col-3 col-form-label">Total Durasi Pekerjaan : </label>
                          <div class="col-6">
                            @php
                            $jumlah=0;
                            foreach ($result as $res) {
                              $str_time = $res->durasi_pekerjaan;
                              sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
                              $time_seconds = isset($seconds) ? $hours * 3600 + $minutes * 60 + $seconds : $hours * 60 + $minutes;
                              $jumlah = $time_seconds + $jumlah;
                            }
                            $hours = floor($jumlah / 3600);
                            $minutes = floor(($jumlah / 60) % 60);
                            $seconds = $jumlah % 60;

                            $total_waktu = "$hours:$minutes:$seconds";
                            //$total_waktu = gmdate('H:i:s', $jumlah);
                            @endphp
                              <input disabled type="text" class="form-control" value="{{$total_waktu}}">
                          </div>
                          <div class="pull-right" class="col-2">
                            <button id="Download" class="btn btn-primary pull-right no-print">Print &nbsp; <i class="fa fa-print"> </i></button>
                          </div>
                          <div style="margin-right:10px;">

                          </div>
                          <div class="pull-right" class="col-2">
                            <a href="/csv/{{ Request::segment(3) }}/{{ Request::segment(4) }}/{{ Request::segment(5) }}" id="CSV" class="btn btn-primary pull-right no-print">Unduh Xls &nbsp; <i class="fa fa-address-card-o"></i></a>
                          </div>
                      </div>
                      @else
                        <div class="form-group row">
                          <table style="width:100%; margin-right:20px; margin-left:20px;" id="contoh" class="table table-bordered table-hover datatable">
                            <thead>
                              <tr>
                                <th>Id</th>
                                <th >Email</th>
                                <th >Nama</th>
                                <th >Lokasi Absen</th>
                                <th >Waktu Absen</th>
                                <th >Waktu Logout</th>
                                <th >Durasi Pekerjaan</th>
                              </tr>
                            </thead>
                            <tr>
                              <td class="text-center" colspan="8"><b> Tak Ditemukan Data Dalam Database </b></td>
                            </tr>
                            </table>

                        </div>
                      @endif
                     <div style="margin-top:30px">

                     </div>
                     <div class="no-print">
                      <h4 class="m-t-0 header-title">Mencari Berdasar Range</h4>
                      <p class="text-muted font-14 m-b-30">
                          Silahkan masukkan dari tanggal berapa ke tanggal berapa anda ingin melihat presensi karyawan anda
                      </p>

                        <form action="" method="post">
                          {{ csrf_field() }}
                          @php
                            use App\karyawanList;
                            $karyawanlist = karyawanList::with('karyawannya')->where('id_manajer','=',Auth::User()->id)->get();
                          @endphp
                          <div class="form-group row">
                            <label class="col-2 col-form-label">Karyawan : </label>
                            <div class="col-10">
                              <select name="id_karyawan" class="form-control select2 js-example-basic-single">
                                <option value="all">Semua Karyawan</option>
                                @foreach ($karyawanlist as $karyawan)
                                  @php
                                    $user = DB::table('users')->where('id','=',$karyawan->id_karyawan)->get()->first();
                                  @endphp
                                  <option value="{{$karyawan->id_karyawan}}">{{$user->nama}} | {{$user->email}}</option>
                                @endforeach
                                </select>
                            </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-2 col-form-label">Tanggal Mulai : </label>
                              @php
                                $current = url()->current();
                                $current = str_replace(URL::to('/'), '',$current);
                                $current = str_replace('/presensi/range', '',$current);
                              @endphp
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
  </div>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
  <script type="text/javascript">
  $(document).ready(function() {
    $("#Download").click( function() {
      $("#Print").print({
                globalStyles: false,
                mediaPrint: false,
                stylesheet: true,
                noPrintSelector: ".no-print",
                iframe: true,
                append: null,
                prepend: null,
                manuallyCopyFormValues: true,
                deferred: $.Deferred(),
                timeout: 750,
                title: 'Laporan Rekapan',
                doctype: '<!doctype html>'
      });
    });
  });
  </script>
  <script type="text/javascript">
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
  </script>
@endsection
