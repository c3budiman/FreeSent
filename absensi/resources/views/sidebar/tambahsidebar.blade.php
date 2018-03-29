@extends('layouts.dlayout')

@section('title')
  Menambah Menu Sidebar
@endsection

@section('content')
  <div class="content">
      <div class="container-fluid">

          <div class="row">
              <div class="col-12">
                  <div class="card-box table-responsive">
                      <h4 class="m-t-0 header-title">Menambah Menu Sidebar</h4>
                      <p class="text-muted font-14 m-b-30">
                          Menambah Sidebar, Untuk menambah submenu pada sidebar, edit sidebar setelah dibuat.
                      </p>

                      <form action="{{url(action('WebAdminController@PostAddSidebar'))}}" method="post">
                        {{ csrf_field() }}
                          <div class="form-group">
                              <label for="namasidebar">Nama Sidebar<span class="text-danger">*</span></label>
                              <input type="text" name="nama" parsley-trigger="change" required placeholder="masukkan nama sidebar" class="form-control">
                          </div>
                          <div class="form-group">
                              <label for="emailAddress">Digunakan oleh : <span class="text-danger">*</span></label>
                              <select class="form-control" name="roles_id">
                                @php
                                  $rolestable = DB::table('roles')->get();
                                @endphp
                                @foreach ($rolestable as $roles)
                                  <option value="{{$roles->id}}">{{$roles->namaRule}}</option>
                                @endforeach
                              </select>
                          </div>
                          <div class="form-group">
                              <label for="pass1">Class CSS<span class="text-danger">*</span></label>
                              <input name="class_css" placeholder="class css" required class="form-control">
                          </div>
                          <div class="form-group">
                              <label for="passWord2">Link/URL <span class="text-danger">*</span></label>
                              <input name="link" required class="form-control" placeholder="Link / URL">
                          </div>

                          <div class="form-group text-right m-b-0">
                              <button class="btn btn-custom waves-effect waves-light" name="submit" type="submit">
                                  <i class="fa fa-plus"> </i> Tambahkan
                              </button>
                              {{-- <input type="submit" name="submit" value="submit" class="btn btn-custom waves-effect waves-light"> --}}
                              <a href="/sidebarsettings" class="btn btn-light waves-effect m-l-5">Cancel</a>
                          </div>

                      </form>

                  </div>
              </div>
          </div>
      </div>
  </div>
@endsection

@section('js')
  <!-- Parsley js -->
  <script type="text/javascript" src="plugins/parsleyjs/parsley.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
        $('form').parsley();
    });
  </script>

@endsection
