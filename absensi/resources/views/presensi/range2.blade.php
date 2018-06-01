@extends('layouts.dlayout')

@php
  $logo = DB::table('setting_situses')->where('id','=','1')->get()->first()->logo;
@endphp

@section('title')
  Presensi Karyawan Berdasarkan Tanggal
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
                    @if ($result->count() > 0)
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
                              <th >Action</th>
                            </tr>
                          </thead>

                            @foreach ($result as $res)
                                <tr>
                                  <td>{{$res->id_tabel}}</td>
                                  <td>{{$res->karyawan->email}}</td>
                                  <td>{{$res->karyawan->nama}}</td>
                                  <td>{{$res->lokasi_absen}}</td>
                                  <td>{{$res->waktu_absen}}</td>
                                  <td>{{$res->waktu_logout}}</td>
                                  <td>{{$res->durasi_pekerjaan}}</td>
                                  <td>Tombol Aksi</td>
                                </tr>
                              @endforeach
                          </table>
                          {{ $result->links() }}
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
                                <th >Action</th>
                              </tr>
                            </thead>
                            <tr>
                              <td class="text-center" colspan="8"><b> Tak Ditemukan Data Dalam Database </b></td>
                            </tr>
                            </table>

                        </div>
                      @endif

                      <h4 class="m-t-0 header-title">Mencari Berdasar Range</h4>
                      <p class="text-muted font-14 m-b-30">
                          Silahkan masukkan dari tanggal berapa ke tanggal berapa anda ingin melihat presensi karyawan anda
                      </p>
                      <form action="" method="post">
                        {{ csrf_field() }}
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
@endsection

@section('js')
  <script type="text/javascript">
  $(document).ready(function() {


  });
  </script>
@endsection
