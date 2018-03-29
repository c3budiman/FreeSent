@extends('layouts.dlayout')

@section('title')
  Mengatur Pengguna
@endsection

@section('content')
  <!-- Start Page content -->
  <div class="content">
      <div class="container-fluid">

          <div class="row">
              <div class="col-12">
                  <div class="card-box table-responsive">
                      <h4 class="m-t-0 header-title">Mengatur Pengguna</h4>
                      <p class="text-muted font-14 m-b-30">
                          Anda bisa menambah, mengedit dan menghapus menu pengguna dimenu ini.
                      </p>
                      <div class="pull-right" style="margin-top:-50px">
                          <a href="#" class="btn btn-xs btn-success"> <i class="fa fa-plus"></i> Tambah</a>
                      </div>

                      <br>

                      <table id="contoh" class="table table-bordered table-hover datatable">
                          <thead>
                              <tr>
                                  <th>id</th>
                                  <th>nama</th>
                                  <th>email</th>
                                  <th>link avatar</th>
                                  <th>roles_id</th>
                                  <th colspan="10%">Action</th>
                              </tr>
                          </thead>
                      </table>
                  </div>
              </div>
          </div>
      </div>
  </div>

@endsection
@section('js')
  <script type="text/javascript">
  $(document).ready(function() {
      $('.datatable').DataTable({
              "language": {
              "url": "https://cdn.datatables.net/plug-ins/1.10.16/i18n/Indonesian-Alternative.json"
          },
          processing: true,
          serverSide: true,
          ajax: '{{ route('user/json') }}',
          columns: [
              {data: 'id', name: 'id'},
              {data: 'nama', name: 'nama'},
              {data: 'email', name: 'email'},
              {data: 'avatar', name: 'avatar'},
              {data: 'roles_id', name: 'roles_id'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });
  });
  </script>
@endsection
