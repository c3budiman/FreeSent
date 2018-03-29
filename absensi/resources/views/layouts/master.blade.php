<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>@yield('judul')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style media="screen">
    html {
      position: relative;
      min-height: 100%;
    }
    body {
      /* Margin bottom by footer height */
      margin-bottom: 60px;
    }
    .footer {
    position: absolute;
    bottom: 0;
    width: 100%;
    height: 60px; /* Set the fixed height of the footer here */
    line-height: 60px; /* Vertically center the text there */
    background-color: #6a6a6a;
    }

    .colornya {
      color: rgb(255, 255, 255);
    }

    table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }

    table, td, th {
      border: 1px solid #000000;
    }

    th, td {
      padding: 15px;
    }

    th {
      color: #ffffff;
      background-color: #2c3e50;
    }
    tr:nth-child(odd) {
      background-color: #ffffff;
    }
    tr:nth-child(even) {
      background-color: #dddddd;
    }
    .konten-kita {
      margin-top: 150px;
      padding-left: 25px;
      padding-right: 25px;
    }

    </style>
  </head>
  <body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">AbsenKu</a>
        </div>

        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav">
            @yield('list')
          </ul>
        </div>

      </div>
    </nav>
    <div style="margin-top:30px;">

    </div>
    @yield('isinya')
    <div class="" style="margin-bottom:40px;">

    </div>
    <footer class="footer">
      <div class="container">
        <span class="text-muted colornya">Copyright 2017 &copy;</span>
      </div>
    </footer>

  </body>
</html>
