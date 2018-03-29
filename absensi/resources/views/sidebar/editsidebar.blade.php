@extends('layouts.dlayout')

@section('title')
  Menyunting Menu Sidebar
@endsection

@section('content')
  <div class="content">
      <div class="container-fluid">

          <div class="row">
              <div class="col-12">
                  <div class="card-box">
                      <h4 class="m-t-0 header-title">Menyunting Menu Sidebar</h4>
                      <p class="text-muted font-14 m-b-30">
                          Menyunting Sidebar, untuk Menyunting sidebar, silahkan isi lalu klik sunting, dan untuk mengatur submenu silahkan pilih edit submenu.
                      </p>

                      <ul class="nav nav-pills navtab-bg nav-justified pull-in ">
                          <li class="nav-item">
                              <a href="#home1" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                  <i class="fi-monitor mr-2"></i> Edit Sidebar
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="#profile1" data-toggle="tab" aria-expanded="true" class="nav-link ">
                                  <i class="fi-head mr-2"></i> Edit Submenu
                              </a>
                          </li>
                      </ul>
                      <div class="tab-content">
                          <div class="tab-pane show active" id="home1">
                              <div class="card-box table-responsive">
                                  <form action="#">
                                      <div class="form-group">
                                          <label for="namasidebar">Nama Sidebar<span class="text-danger">*</span></label>
                                          <input type="text" name="nama" parsley-trigger="change" required value="{{$sidebar->nama}}" class="form-control">
                                      </div>
                                      <div class="form-group">
                                          <label for="emailAddress">Digunakan oleh : <span class="text-danger">*</span></label>
                                          <select class="form-control" name="">
                                              @php $rolestable = DB::table('roles')->get(); @endphp
                                              <option value="{{$sidebar->kepunyaan}}">{{DB::table('roles')->where('id','=',$sidebar->kepunyaan)->get()->first()->namaRule}}</option>
                                              @foreach ($rolestable as $roles) @continue($roles->id === $sidebar->kepunyaan)
                                              <option value="{{$roles->id}}">{{$roles->namaRule}}</option>
                                              @endforeach
                                          </select>
                                      </div>
                                      <div class="form-group">
                                          <label for="pass1">Class CSS<span class="text-danger">*</span></label>
                                          <input name="classcss" value="{{$sidebar->class_css}}" required class="form-control">
                                      </div>
                                      <div class="form-group">
                                          <label for="passWord2">Link/URL <span class="text-danger">*</span></label>
                                          <input required class="form-control" value="{{$sidebar->link}}">
                                      </div>

                                      <div class="form-group text-right m-b-0">
                                          <button class="btn btn-custom waves-effect waves-light" type="submit">
                                              <i class="fa fa-edit"> </i> Sunting
                                          </button>
                                          <a href="/sidebarsettings" class="btn btn-light waves-effect m-l-5">Cancel</a>
                                      </div>
                                  </form>
                              </div>
                          </div>
                          <div class="tab-pane" id="profile1">
                            <div class="col-12">
                                <div class="card-box table-responsive">
                                    <h4 class="m-t-0 header-title">Mengatur Menu Sidebar</h4>
                                    <p class="text-muted font-14 m-b-30">
                                        disini kamu bisa mengatur submenu untuk sidebar : {{$sidebar->nama}}
                                    </p>
                                    <div class="pull-right" style="margin-top:-80px">
                                        <a href="/addsubmenu/withid/{{$sidebar->id}}" class="btn btn-xs btn-success"> <i class="fa fa-plus"></i> Tambah</a>
                                    </div>

                                    <table style="width:100%;" id="contoh" class="table table-bordered table-hover datatable">
                                        <thead>
                                            <tr>
                                                <th>id</th>
                                                <th>kepunyaan</th>
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
              </div>
          </div>
      </div>
  </div>
@endsection

@section('js')
  <!-- Parsley js -->
  <script type="text/javascript" src="{{ URL::asset('plugins/parsleyjs/parsley.min.js') }}"></script>
  <script type="text/javascript">
    $(document).ready(function() {
        $('form').parsley();
    });
  </script>

  <script type="text/javascript">
  $(document).ready(function() {
      $('.datatable').DataTable({
              "language": {
              "url": "https://cdn.datatables.net/plug-ins/1.10.16/i18n/Indonesian-Alternative.json"
          },
          processing: true,
          serverSide: true,
          ajax: 'http://localhost:8000/submenu/json/{{$id}}',
          columns: [
              {data: 'id', name: 'id'},
              {data: 'kepunyaan', name: 'kepunyaan'},
              {data: 'nama', name: 'nama'},
              {data: 'link', name: 'link'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });
  });
  </script>

@endsection
