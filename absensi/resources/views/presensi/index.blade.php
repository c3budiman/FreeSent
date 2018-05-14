@php
  $logo = DB::table('setting_situses')->where('id','=','1')->get()->first()->logo;
@endphp

@extends('layouts.dlayout');

@section('title')
  Presensi Karyawan
@endsection

@section('csstambahan')
      <!-- Plugins css-->
    <link href="../plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css" rel="stylesheet" />
    <link href="../plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" />
    <link href="../plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="../plugins/switchery/switchery.min.css">
@endsection

@section('content')
  <!-- Start Page content -->
  <div class="content">
      <div class="container-fluid">

          <div class="row">
              <div class="col-12">
                  <div class="card-box table-responsive">
                      <h4 class="m-t-0 header-title">Mengatur Presensi</h4>
                      <p class="text-muted font-14 m-b-30">
                          Anda bisa melihat detail presensi, mengedit dan menghapus presensi karyawan anda dimenu ini.
                      </p>

                      {!! $dataTable->table() !!}
                  </div>
              </div>
          </div>
      </div>
  </div>

  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">

          <div class="deleteContent">
            Apakah anda yakin akan mendelete karyawan <span class="nama-kar"></span> ?
              <input type="hidden" id="iddelete">
          </div>


          <div class="modal-footer">
            <button type="button" class="btn actionBtn" data-dismiss="modal">
              <span id="footer_action_button" class='glyphicon'> </span>
            </button>
            <button type="button" class="btn btn-warning" data-dismiss="modal">
              <span class='glyphicon glyphicon-remove'></span> Batal
            </button>
          </div>


        </div>
      </div>
    </div>
  </div>


  <!-- Signup modal content -->
  <div id="signup-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog">
          <div class="modal-content">

              <div class="modal-body">
                  <h2 class="text-uppercase text-center m-b-30">
                      <a href="index.html" class="text-success">
                          <span><img src="{{ asset($logo)}}" alt="" height="40"></span>
                      </a>
                  </h2>

                    <div class="form-group m-b-25">
                        <div class="col-12">
                          {{csrf_field()}}
                            <label for="emailaddress">Alamat Email : </label>
                            <input class="form-control" type="email" id="emaildaftar" required="" placeholder="email@domain.com" name="email">
                        </div>
                    </div>

                      <div class="form-group m-b-25">
                          <div class="col-12">
                              <label for="username">Nama</label>
                              <input class="form-control" type="text" id="namadaftar" placeholder="nama">
                          </div>
                      </div>

                      <div style="padding-top:10px">
                      </div>

                      <div class="form-group m-b-25">
                          <div class="col-12">
                              <label for="password">Password</label>
                              <input name="password" class="form-control" type="password" required="" id="passworddaftar" placeholder="password">
                          </div>
                      </div>

                      <div class="form-group account-btn text-center m-t-10">
                          <div class="col-12">
                              <button id="submit" class="btn w-lg btn-rounded btn-primary waves-effect waves-light" type="submit">Daftarkan</button>
                          </div>
                      </div>
              </div>
          </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->




  <div id="tambahbyregistered" class="modal fade" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-body">
                  <h2 class="text-uppercase text-center m-b-30">
                      <a href="index.html" class="text-success">
                          <span><img src="{{ asset($logo)}}" alt="" height="40"></span>
                      </a>
                  </h2>
                  <div class="form-group m-b-25">
                      <div class="col-12">
                        @php
                          $karyawan = DB::Table('users')->where('roles_id','=','3')->get();
                          $relasi = DB::Table('data_karyawan')->get();
                        @endphp
                        <select name="id_karyawan" class="form-control select2">
                              <option>Pilih</option>
                                @foreach ($karyawan as $kary)
                                    @continue(!empty(DB::Table('data_karyawan')->where('id_karyawan','=',$kary->id)->get()->first()))
                                    <option value="{{$kary->id}}">{{$kary->nama}} | {{$kary->email}}</option>
                                @endforeach
                        </select>
                      </div>
                  </div>

                  <div style="padding-top:10px">
                  </div>

                  <div class="form-group account-btn text-center m-t-10">
                      <div class="col-12">
                          <button id="submit2" class="btn w-lg btn-rounded btn-primary waves-effect waves-light" type="submit">Daftarkan</button>
                      </div>
                  </div>
              </div>
          </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

  @foreach ($beritanya as $berita)
    @if (DB::table('tb_news')->where($berita->status,'=','1')->first()->status == '1')
      Aktif
    @else
      Tidak Aktif
    @endif
  @endforeach

{{ $aktif }}
{!! $status !!}
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
  <script src="/vendor/datatables/buttons.server-side.js"></script>
  {!! $dataTable->scripts() !!}

  <script type="text/javascript">

  $(document).ready(function() {
    // $('.datatable').DataTable({
    //         "language": {
    //         "url": "https://cdn.datatables.net/plug-ins/1.10.16/i18n/Indonesian-Alternative.json"
    //     },
    //     processing: true,
    //     serverSide: true,
    //     ajax: '{{ route('presensi/json') }}',
    //     columns: [
    //         {data: 'id', name: 'id'},
    //         {data: 'karyawan.email', name: 'karyawan.email'},
    //         {data: 'karyawan.nama', name: 'karyawan.nama'},
    //         {data: 'lokasi_absen', name: 'lokasi_absen'},
    //         {data: 'waktu_absen', name: 'waktu_absen'},
    //         {data: 'waktu_logout', name: 'waktu_logout'},
    //         {data: 'durasi_pekerjaan', name: 'durasi_pekerjaan'},
    //         {data: 'action', name: 'action', orderable: false, searchable: false},
    //     ]
    // });

    // ShowModals
      $(document).on('click', '#tambah', function() {
          $('#signup-modal').modal('show');
      });

      // ShowModals
        $(document).on('click', '#tambah2', function() {
            $('#tambahbyregistered').modal('show');
        });

      $("#submit").click(function(){
        $.ajax({
            type: "POST",
            url: "/karyawanregistrasi",
            dataType: "json",
            data: {
              '_token': $('input[name=_token]').val(),
              email: $("#emaildaftar").val(),
              nama: $("#namadaftar").val(),
              avatar: "avatar/avatar.png",
              roles_id: "3",
              password: $("#passworddaftar").val(),
            },
            success: function (data, status) {
                $('#signup-modal').modal('hide');
                $("#emaildaftar").val(''),
                $("#namadaftar").val(''),
                $("#passworddaftar").val(''),
                $('.datatable').DataTable().ajax.reload(null, false);
            },
            error: function (request, status, error) {
                console.log(request.responseJSON);
                $.each(request.responseJSON.errors, function( index, value ) {
                  alert( value );
                });
            }
        });
      });

      $("#submit2").click(function(){
        $.ajax({
            type: "POST",
            url: "/karyawanregistrasiv2",
            dataType: "json",
            data: {
              '_token': $('input[name=_token]').val(),
              id_user: $('select[name=id_karyawan]').val(),
            },
            success: function (data, status) {
                location.reload();
                $('.datatable').DataTable().ajax.reload(null, false);
            },
            error: function (request, status, error) {
                console.log(request.responseJSON);
                $.each(request.responseJSON.errors, function( index, value ) {
                  alert( value );
                });
            }
        });
      });

      $(document).on('click', '.delete-modal', function() {
          $('#footer_action_button').text(" Delete");
          $('#footer_action_button').removeClass('glyphicon-check');
          $('#footer_action_button').addClass('glyphicon-trash');
          $('.actionBtn').removeClass('btn-success');
          $('.actionBtn').addClass('btn-danger');
          $('.actionBtn').addClass('delete');
          $('.modal-title').text('Delete');
          $('.did').text($(this).data('id'));
          $('.nama-kar').text($(this).data('nama'));
          $('.deleteContent').show();
          $('.form-horizontal').hide();
          $('#iddelete').val($(this).data('id'));
          $('#myModal').modal('show');
      });

      $('.modal-footer').on('click', '.delete', function() {
          $.ajax({
              type: "POST",
              url: "/karyawan/delete",
              dataType: "json",
              data: {
                '_token': $('input[name=_token]').val(),
                id_tabel: $("#iddelete").val(),
              },
              success: function (data, status) {
                  location.reload();
              },
              error: function (request, status, error) {
                  console.log($("#iddelete").val());
                  console.log(request.responseJSON);
                  $.each(request.responseJSON.errors, function( index, value ) {
                    alert( value );
                  });
              }
          });
      });
  });
  </script>

  <!-- Init Js file -->
  <script type="text/javascript" src="assets/pages/jquery.form-advanced.init.js"></script>


@endsection
