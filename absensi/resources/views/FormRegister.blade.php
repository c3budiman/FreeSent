<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>FreeSent Platform Absen</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="images/favicon.png">

        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/metismenu.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />

        <script src="assets/js/modernizr.min.js"></script>

    </head>


    <body class="account-pages">

        <!-- Begin page -->
        <div class="accountbg" style="background: url('images/auth/bg.jpg');background-size: cover;"></div>

        <div class="wrapper-page account-page-full">
            <div class="card">
                <div class="card-block">
                    <div class="account-box">

                        <div class="card-box p-5">
                            <h2 class="text-uppercase text-center pb-4">
                                <a href="index.html" class="text-success">
                                    <span><img src="images/logo.png" alt="" height="100"></span>
                                </a>
                            </h2>


                            <form method="post" class="form-horizontal" action="{{url(action('regisController@postRegis'))}}">
                              {{ csrf_field() }}

                                <div class="form-group row m-b-20">
                                    <div class="col-12">
                                        <label for="username">Nama Lengkap</label>
                                        <input name="nama" class="form-control" type="text" id="username" required placeholder="Michael Zenaty">
                                    </div>
                                </div>

                                <div class="form-group row m-b-20">
                                    <div class="col-12">
                                        <label for="emailaddress">Email</label>
                                        <input name="email" class="form-control" type="email" id="emailaddress" required placeholder="john@deo.com">
                                    </div>
                                </div>

                                <div class="form-group row m-b-20">
                                    <div class="col-12">
                                        <label for="emailaddress">url Avatar</label>
                                        <input name="avatar" class="form-control" type="text" id="no_telp" required placeholder="No Telepon">
                                    </div>
                                </div>

                                <div class="form-group row m-b-20">
                                    <div class="col-12">
                                        <label for="password">Password</label>
                                        <input name="password" class="form-control" type="password" required="" id="password" placeholder="Enter your password">
                                    </div>
                                </div>

                                {{-- <div class="form-group row m-b-20">
                                    <div class="col-12">

                                        <div class="checkbox checkbox-custom">
                                            <input id="remember" type="checkbox" checked="">
                                            <label for="remember">
                                                I accept <a href="#" class="text-custom">Terms and Conditions</a>
                                            </label>
                                        </div>

                                    </div>
                                </div> --}}

                                <div class="form-group row text-center m-t-10">
                                    <div class="col-12">
                                        <button class="btn btn-block btn-custom waves-effect waves-light" type="submit">Sign Up Free</button>
                                    </div>
                                </div>

                            </form>

                            {{-- <div class="row m-t-50">
                                <div class="col-sm-12 text-center">
                                    <p class="text-muted">Already have an account?  <a href="page-login.html" class="text-dark m-l-5"><b>Sign In</b></a></p>
                                </div>
                            </div> --}}

                        </div>
                    </div>

                </div>
            </div>

            {{-- <div class="m-t-40 text-center">
                <p class="account-copyright">2018 © Highdmin. - Coderthemes.com</p>
            </div> --}}

        </div>



        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/metisMenu.min.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

    </body>
</html>