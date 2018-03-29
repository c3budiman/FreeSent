@extends('layouts.dlayout')

@section('title')
  Mengatur Menu Sidebar
@endsection

@section('content')
  <!-- Start Page content -->
  <div class="content">
      <div class="container-fluid">

          <div class="row">
              <div class="col-12">
                  <div class="card-box table-responsive">
                      <h4 class="m-t-0 header-title">Mengatur Menu Sidebar</h4>
                      <p class="text-muted font-14 m-b-30">
                          Anda bisa menambah, mengedit dan menghapus menu sidebar yang nantinya akan menjadi menu untuk anda dan user lainnya.
                      </p>
                      <div class="pull-right" style="margin-top:-50px">
                          <a href="/addsidebar" class="btn btn-xs btn-success"> <i class="fa fa-plus"></i> Tambah</a>
                      </div>

                      <br>

                      <table id="contoh" class="table table-bordered table-hover datatable">
                          <thead>
                              <tr>
                                  <th>id</th>
                                  <th>roles_id</th>
                                  <th>class_css</th>
                                  <th>nama</th>
                                  <th>link</th>
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
          ajax: '{{ route('sidebar/json') }}',
          columns: [
              {data: 'id', name: 'id'},
              {data: 'kepunyaan', name: 'kepunyaan'},
              {data: 'class_css', name: 'class_css'},
              {data: 'nama', name: 'nama'},
              {data: 'link', name: 'link'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });
  });
  </script>
@endsection
