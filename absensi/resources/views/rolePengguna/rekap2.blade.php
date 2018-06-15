@extends('layouts.dlayout')

@section('title')
  FreeSent Dashboard {{DB::table('roles')->where('id','=','3')->get()->first()->namaRule}}
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
                            {{ $result->links() }}
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
                              $total_waktu = gmdate('H:i:s', $jumlah);
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

                        <h4 class="m-t-0 header-title">Mencari Berdasar Range</h4>
                        <p class="text-muted font-14 m-b-30">
                            Silahkan masukkan dari tanggal berapa ke tanggal berapa, presensi yang ingin anda lihat
                        </p>
                        <form action="{{url(action('UserController@postPresensiRange'))}}" method="post">
                          {{ csrf_field() }}
                          <div class="form-group row">
                              <label class="col-2 col-form-label">Tanggal Mulai : </label>
                              @php
                                $current = url()->current();
                                $current = str_replace(URL::to('/'), '',$current);
                                $current = str_replace('/rekap/range', '',$current);
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


@section('jstambahan')
  <!-- Sweet Alert Js  -->
  <script src="plugins/sweet-alert/sweetalert2.min.js"></script>

  @if (session('status'))
    <script type="text/javascript">
    !function ($) {
      "use strict";
      var SweetAlert = function () {
      };
      SweetAlert.prototype.init = function () {
          $(document).ready(function () {
              swal(
                  {
                      title: 'Sukses!',
                      text: '{{ session('status') }}',
                      type: 'success',
                      confirmButtonClass: 'btn btn-confirm mt-2'
                  }
              )
          });
        },
     $.SweetAlert = new SweetAlert, $.SweetAlert.Constructor = SweetAlert
          }(window.jQuery),
            function ($) {
                "use strict";
                $.SweetAlert.init()
            } (window.jQuery);
    </script>
  @endif

  @if($errors->any())
  <script type="text/javascript">
  !function ($) {
    "use strict";
    var SweetAlert = function () {
    };
    SweetAlert.prototype.init = function () {
        $(document).ready(function () {
            swal(
                {
                    title: 'Error!',
                    text: '{{$errors->first()}}',
                    type: 'error',
                    confirmButtonClass: 'btn btn-confirm mt-2'
                }
            )
        });
      },
   $.SweetAlert = new SweetAlert, $.SweetAlert.Constructor = SweetAlert
        }(window.jQuery),
          function ($) {
              "use strict";
              $.SweetAlert.init()
          } (window.jQuery);
  </script>
  @endif
@endsection
