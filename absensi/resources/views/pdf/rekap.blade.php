@extends('layouts.dlayout')

@php
  $logo = DB::table('setting_situses')->where('id','=','1')->get()->first()->logo;
@endphp

@section('title')
  Presensi Karyawan Berdasarkan Tanggal |
@endsection

@section('csstambahan')
      <!-- Plugins css-->

    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')

  <!-- Start Page content -->
  <div class="content">
      <div class="container-fluid">

          <div class="row">
              <div class="col-12">
                  <div class="card-box table-responsive">
                    @if (count($result) > 0)
                      <h4 class="m-t-0 header-title">Hasil Pencarian Range Presensi</h4>

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
                          <div class="col-9">
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
                  </div>
              </div>
          </div>
      </div>
  </div>
@endsection
