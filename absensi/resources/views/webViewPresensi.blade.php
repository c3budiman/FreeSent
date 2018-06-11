<script src="{{ URL::asset('assets/js/jquery.min.js') }}"></script>
<!-- App css -->
<link href="{{URL::asset('plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
<link href="{{URL::asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('assets/css/metismenu.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('assets/css/style.css') }}" rel="stylesheet" type="text/css" />
<script src="{{ URL::asset('assets/js/modernizr.min.js') }}"></script>
<!-- DataTables -->
<link href="{{URL::asset('plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Responsive datatable examples -->
<link href="{{URL::asset('plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Sweet Alert css -->
<link href="{{URL::asset('plugins/sweet-alert/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Bootstrap fileupload css -->
<link href="{{URL::asset('plugins/bootstrap-fileupload/bootstrap-fileupload.css') }}" rel="stylesheet" />
<!-- Table Responsive css -->
<link href="{{URL::asset('plugins/responsive-table/css/rwd-table.min.css') }}" rel="stylesheet" type="text/css" media="screen">


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
                            <th>Tanggal</th>
                            <th >Durasi Pekerjaan</th>
                          </tr>
                        </thead>

                          @foreach ($result as $res)
                              <tr>
                                <td>{{$res->waktu_absen}}</td>
                                <td>{{$res->durasi_pekerjaan}}</td>
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
                              <th>Tanngal</th>
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
