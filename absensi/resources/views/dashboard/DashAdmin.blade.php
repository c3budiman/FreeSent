@extends('layouts.dlayout')
@section('title') FreeSent WebAdmin Dashboard @endsection

@section('content')
<div class="row text-center">
    <div class="col-sm-6 col-lg-6 col-xl-3">
        <div class="card-box widget-flat border-success bg-success text-white">
            <i class="fa fa-check-square-o"></i>
            <h3 class="m-b-10">25563</h3>
            <p class="text-uppercase m-b-5 font-13 font-600">Total Absen</p>
        </div>
    </div>
    <div class="col-sm-6 col-lg-6 col-xl-3">
        <div class="card-box bg-primary widget-flat border-primary text-white">
            <i class="fa fa-user"></i>
            <h3 class="m-b-10">6952</h3>
            <p class="text-uppercase m-b-5 font-13 font-600">Total Mahasiswa</p>
        </div>
    </div>
    <div class="col-sm-6 col-lg-6 col-xl-3">
        <div class="card-box widget-flat border-custom bg-custom text-white">
            <i class="fa fa-user-secret"></i>
            <h3 class="m-b-10">18361</h3>
            <p class="text-uppercase m-b-5 font-13 font-600">Total Staff</p>
        </div>
    </div>
    <div class="col-sm-6 col-lg-6 col-xl-3">
        <div class="card-box bg-danger widget-flat border-danger text-white">
            <i class="fa fa-institution"></i>
            <h3 class="m-b-10">250</h3>
            <p class="text-uppercase m-b-5 font-13 font-600">Total Kelas</p>
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
                    <span class="tran-text">Jono</span>
                    <span class="pull-right text-success tran-price">3KA01</span>
                    <span class="pull-right text-muted">07/09/2017</span>
                    <span class="clearfix"></span>
                </li>

                <li>
                    <i class="dripicons-checkmark text-warning"></i>
                    <span class="tran-text">Linda</span>
                    <span class="pull-right text-warning tran-price">3KA15</span>
                    <span class="pull-right text-muted">07/09/2017</span>
                    <span class="clearfix"></span>
                </li>

                <li>
                    <i class="dripicons-checkmark text-danger"></i>
                    <span class="tran-text">Lisa</span>
                    <span class="pull-right text-danger tran-price">3KA15</span>
                    <span class="pull-right text-muted">07/09/2017</span>
                    <span class="clearfix"></span>
                </li>

                <li>
                    <i class="dripicons-checkmark text-danger"></i>
                    <span class="tran-text">Lisa</span>
                    <span class="pull-right text-danger tran-price">3KA15</span>
                    <span class="pull-right text-muted">07/09/2017</span>
                    <span class="clearfix"></span>
                </li>

                <li>
                    <i class="dripicons-arrow-down text-success"></i>
                    <span class="tran-text">Advertising</span>
                    <span class="pull-right text-success tran-price">+$230</span>
                    <span class="pull-right text-muted">05/09/2017</span>
                    <span class="clearfix"></span>
                </li>

                <li>
                    <i class="dripicons-arrow-up text-danger"></i>
                    <span class="tran-text">New plugins added</span>
                    <span class="pull-right text-danger tran-price">-$452</span>
                    <span class="pull-right text-muted">05/09/2017</span>
                    <span class="clearfix"></span>
                </li>

                <li>
                    <i class="dripicons-arrow-down text-success"></i>
                    <span class="tran-text">Google Inc.</span>
                    <span class="pull-right text-success tran-price">+$230</span>
                    <span class="pull-right text-muted">04/09/2017</span>
                    <span class="clearfix"></span>
                </li>

                <li>
                    <i class="dripicons-arrow-up text-danger"></i>
                    <span class="tran-text">Facebook Ad</span>
                    <span class="pull-right text-danger tran-price">-$364</span>
                    <span class="pull-right text-muted">03/09/2017</span>
                    <span class="clearfix"></span>
                </li>

                <li>
                    <i class="dripicons-arrow-down text-success"></i>
                    <span class="tran-text">New sale</span>
                    <span class="pull-right text-success tran-price">+$230</span>
                    <span class="pull-right text-muted">03/09/2017</span>
                    <span class="clearfix"></span>
                </li>

                <li>
                    <i class="dripicons-arrow-down text-success"></i>
                    <span class="tran-text">Advertising</span>
                    <span class="pull-right text-success tran-price">+$230</span>
                    <span class="pull-right text-muted">29/08/2017</span>
                    <span class="clearfix"></span>
                </li>

                <li>
                    <i class="dripicons-arrow-up text-danger"></i>
                    <span class="tran-text">Support licence</span>
                    <span class="pull-right text-danger tran-price">-$854</span>
                    <span class="pull-right text-muted">27/08/2017</span>
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
