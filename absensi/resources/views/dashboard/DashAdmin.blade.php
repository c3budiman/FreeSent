@extends('layouts.dlayout')
@section('title') FreeSent WebAdmin Dashboard @endsection

@section('content')
<div class="row text-center">
    <div class="col-sm-6 col-lg-6 col-xl-3">
        <div class="card-box widget-flat border-success bg-success text-white">
            <i class="fa fa-check-square-o"></i>
            <h3 class="m-b-10">10</h3>
            <p class="text-uppercase m-b-5 font-13 font-600">Total Absen</p>
        </div>
    </div>
    <div class="col-sm-6 col-lg-6 col-xl-3">
        <div class="card-box bg-primary widget-flat border-primary text-white">
            <i class="fa fa-user"></i>
            <h3 class="m-b-10">4</h3>
            <p class="text-uppercase m-b-5 font-13 font-600">Total {{DB::table('roles')->where('id','=','3')->get()->first()->namaRule}}</p>
        </div>
    </div>
    <div class="col-sm-6 col-lg-6 col-xl-3">
        <div class="card-box widget-flat border-custom bg-custom text-white">
            <i class="fa fa-user-secret"></i>
            <h3 class="m-b-10">5</h3>
            <p class="text-uppercase m-b-5 font-13 font-600">Total {{DB::table('roles')->where('id','=','2')->get()->first()->namaRule}}</p>
        </div>
    </div>
    <div class="col-sm-6 col-lg-6 col-xl-3">
        <div class="card-box bg-danger widget-flat border-danger text-white">
            <i class="fa fa-institution"></i>
            <h3 class="m-b-10">3</h3>
            <p class="text-uppercase m-b-5 font-13 font-600">Total Region</p>
        </div>
    </div>
</div>
<!-- end row -->


<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <h4 class="header-title mb-4">Absen Terbaru <br>
              <small><i class="dripicons-checkmark text-success"></i> = masuk, <i class="dripicons-checkmark text-warning"></i> ijin/sakit, <i class="dripicons-checkmark text-danger"></i> = alfa</small>
            </h4>

            <ul class="list-unstyled transaction-list slimscroll mb-0" style="max-height: 150px;">
                <li>
                    <i class="dripicons-checkmark text-success"></i>
                    <span class="text-success tran-text">01 JAM</span>
                    <span class="tran-text">Jono</span>
                    <span class="tran-price">Jakarta</span>
                    <span class="pull-right text-muted">07/09/2017</span>
                    <span class="clearfix"></span>
                </li>

                <li>
                    <i class="dripicons-checkmark text-warning"></i>
                    <span class="text-warning tran-text">00 JAM</span>
                    <span class="tran-text">Linda</span>
                    <span class="tran-price">Bogor</span>
                    <span class="pull-right text-muted">07/09/2017</span>
                    <span class="clearfix"></span>
                </li>

                <li>
                    <i class="dripicons-checkmark text-danger"></i>
                    <span class="text-danger tran-text">00 JAM</span>
                    <span class="tran-text">Lisa</span>
                    <span class="tran-price">Surabaya</span>
                    <span class="pull-right text-muted">07/09/2017</span>
                    <span class="clearfix"></span>
                </li>

                <li>
                    <i class="dripicons-checkmark text-danger"></i>
                    <span class="text-warning tran-text">00 JAM</span>
                    <span class="tran-text">Lisa</span>
                    <span class="tran-price">Surabaya</span>
                    <span class="pull-right text-muted">07/09/2017</span>
                    <span class="clearfix"></span>
                </li>

                <li>
                    <i class="dripicons-checkmark text-danger"></i>
                    <span class="text-danger tran-text">01 JAM</span>
                    <span class="tran-text">Lisa</span>
                    <span class="tran-price">Surabaya</span>
                    <span class="pull-right text-muted">07/09/2017</span>
                    <span class="clearfix"></span>
                </li>

            </ul>
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
