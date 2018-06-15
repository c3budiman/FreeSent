@extends('layouts.dlayout')

@section('title')
  FreeSent {{DB::table('roles')->where('id','=','2')->get()->first()->namaRule}} Dashboard
@endsection



@section('content')
  @php
    $berita = DB::table('berita')->get()->take(3);
  @endphp
  <div class="row">
  @foreach ($berita as $berita)
    <div class="col-lg-4">
        <div class="card-box ribbon-box">
            <div class="ribbon ribbon-custom">Pengumuman</div>
            <p> <b>{{$berita->judul}}</b>  </p>
            <p class="m-b-0">{{substr(strip_tags($berita->content),0,100)}}</p>
            <a class="btn btn-sm btn-info pull-right" href="/berita/{{$berita->id_berita}}">Baca...</a>
            <div style="padding-bottom: 25px;">

            </div>
        </div>
    </div>
  @endforeach
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card m-b-30">
        <h6 class="card-header">FreeSent App</h6>
        <div class="card-body">
            <h5 class="card-title">FreeSent App</h5>
            <p class="card-text">Agar anda dapat mengisi presensi, silahkan download app kami.</p>
            <a type="button" href="/App/freesent.apk" class="btn btn-primary waves-effect waves-light"> <i class="fa fa-download m-r-5"></i> <span>Download</span> </a>
        </div>
      </div>
    </div>
  </div>
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
