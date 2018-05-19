<!DOCTYPE html>
<head>
  <title>Pusher Test</title>
  <script src="https://js.pusher.com/4.1/pusher.min.js"></script>
  <script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = false;

    var pusher = new Pusher('dc6a1819038c28e12f36', {
      cluster: 'ap1',
      encrypted: true,
      authEndpoint: '/broadcasting/auth',
      auth: {
      headers: {
              'X-CSRF-Token': '{{ csrf_token() }}'
          }
      }
    });

    var channel = pusher.subscribe('private-dbEvent');
    channel.bind('App\\Events\\dbEvent', function(data) {
      alert(data.message);
    });
  </script>
</head>
