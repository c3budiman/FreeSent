@extends('layouts.dlayout')

@section('title')
  FreeSent {{DB::table('roles')->where('id','=','2')->get()->first()->namaRule}} Dashboard
@endsection



@section('content')
<div class="row text-center">
    <div class="col-sm-6 col-lg-6 col-xl-6">
        <div class="card-box widget-flat border-success bg-success text-white">
            <i class="fa fa-check-square-o"></i>
            <h3 class="m-b-10">{{DB::table('daftar_presensis')->where('id_manajer','=',Auth::User()->id)->get()->count()}}</h3>
            <p class="text-uppercase m-b-5 font-13 font-600">Presensi Masuk</p>
        </div>
    </div>
    <div class="col-sm-6 col-lg-6 col-xl-6">
        <div class="card-box bg-primary widget-flat border-primary text-white">
            <i class="fa fa-user"></i>
            <h3 class="m-b-10">{{DB::table('data_karyawan')->where('id_manajer','=',Auth::User()->id)->get()->count()}}</h3>
            <p class="text-uppercase m-b-5 font-13 font-600">Total Karyawan Anda</p>
        </div>
    </div>
</div>
<!-- end row -->
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
