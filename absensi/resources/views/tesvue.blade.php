<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Tes</title>
    <link rel="stylesheet" href="css/app.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
  </head>
  <body>
    <div id="app">
      <h1>tes</h1>
      <example-component> </example-component>
    </div>
    <script src="js/app.js" type="text/javascript">

    </script>
    <script type="text/javascript">
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    </script>
  </body>
</html>
