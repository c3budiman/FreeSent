@extends('layouts.dlayout')

@section('title')
  Ubah Logo Situs
@endsection

@section('content')
  <div class="row">
      <div class="col-12">
          <div class="card-box">
              <h4 class="header-title m-t-0">Mengubah Logo Situs</h4>
              <p class="text-muted font-14 m-b-10">
                  Anda dapat mengganti logo situs yang digunakan disini
              </p>

              <form enctype="multipart/form-data" action="{{url(action("authController@UpdateProfile"))}}" method="post" class="form-horizontal ">
                  {{ csrf_field() }}
                  <div class="form-group row">
                      <label class="col-3 col-form-label">Logo Situs</label>
                      <div class="col-9">
                          <div class="fileupload fileupload-new" data-provides="fileupload">
                              <div class="fileupload-new thumbnail" style="height: 128px;">
                                @php
                                  $logo = DB::table('setting_situses')->where('id','=','1')->get()->first()->logo;
                                @endphp
                                  @if ($logo != null || $logo != "")
                                  <img src="{{$logo}}" alt="image" /> @else
                                  <img src="/images/logosimple.png" alt="image" /> @endif
                              </div>
                              <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                              <div>
                                  <button type="button" class="btn btn-custom btn-file">
                                   <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Pilih Gambar</span>
                                   <span class="fileupload-exists"><i class="fa fa-undo"></i> Ganti</span>
                                   <input accept="image/*" type="file" class="btn-light" name="tes" id="exampleInputFile">
                                 </button>
                              </div>
                          </div>
                      </div>
                  </div>
                  <hr>
                  <div class="form-group row">
                      <label class="col-3 col-form-label">Favicon Situs</label>
                      <div class="col-9">
                          <div class="fileupload fileupload-new" data-provides="fileupload">
                              <div class="fileupload-new thumbnail" style="height: 128px;">
                                @php
                                  $logo = DB::table('setting_situses')->where('id','=','1')->get()->first()->favicon;
                                @endphp
                                  @if ($logo != null || $logo != "")
                                  <img src="{{$logo}}" alt="image" /> @else
                                  <img src="/images/logosimple.png" alt="image" /> @endif
                              </div>
                              <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                              <div>
                                  <button type="button" class="btn btn-custom btn-file">
                                   <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Pilih Gambar</span>
                                   <span class="fileupload-exists"><i class="fa fa-undo"></i> Ganti</span>
                                   <input accept="image/*" type="file" class="btn-light" name="tes" id="exampleInputFile">
                                 </button>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="form-group row">
                      <div class="col-12">
                          <div class="pull-right">
                              <button type="submit" name="button" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                          </div>
                      </div>
                  </div>
                  <input type="hidden" name="_method" value="PUT">
              </form>
          </div>
      </div>
  </div>
  <!--  end row -->
@endsection
