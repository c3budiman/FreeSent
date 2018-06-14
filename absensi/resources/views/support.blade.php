@extends('layouts.dlayout')
@section('title') FreeSent {{DB::table('roles')->where('id','=','1')->get()->first()->namaRule}} Dashboard @endsection

@section('content')
  <div class="row">
                              <div class="col-lg-12">
                                  <div id="accordion" role="tablist" aria-multiselectable="true" class="m-b-30">
                                      <div class="card">
                                          <div class="card-header" role="tab" id="headingOne">
                                              <h5 class="mb-0 mt-0">
                                                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="text-dark collapsed" aria-expanded="false" aria-controls="collapseOne">
                                                      Bagaimana Cara Mendaftarkan admin?
                                                  </a>
                                              </h5>
                                          </div>

                                          <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne" style="">
                                              <div class="card-body">
                                                  Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                              </div>
                                          </div>
                                      </div>
                                      <div class="card">
                                          <div class="card-header" role="tab" id="headingTwo">
                                              <h5 class="mb-0 mt-0">
                                                  <a class="text-dark collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                      Bagaimana Cara Admin Membuka Sesi Presensi?
                                                  </a>
                                              </h5>
                                          </div>
                                          <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" style="">
                                              <div class="card-body">
                                                  Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                              </div>
                                          </div>
                                      </div>
                                      <div class="card">
                                          <div class="card-header" role="tab" id="headingThree">
                                              <h5 class="mb-0 mt-0">
                                                  <a class="text-dark collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                      Bagaimana Cara User untuk Absen dan Mengakses Rekap?
                                                  </a>
                                              </h5>
                                          </div>
                                          <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree" style="">
                                              <div class="card-body">
                                                  Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                              </div>
                                          </div>
                                      </div>
                                      <div class="card">
                                          <div class="card-header" role="tab" id="headingFour">
                                              <h5 class="mb-0 mt-0">
                                                  <a class="text-dark collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                                      Siapakah Pembuat Sistem Presensi Ini?
                                                  </a>
                                              </h5>
                                          </div>
                                          <div id="collapseFour" class="collapse" role="tabpanel" aria-labelledby="headingFour" style="">
                                              <div class="card-body">
                                                  Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
<!-- end row -->
@endsection


@section('jstambahan')

@endsection
