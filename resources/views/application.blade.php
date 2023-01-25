<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>RRHH ERP2</title>

  <!-- Favicon -->
  <link rel="shortcut icon" href="{{ asset('ua-logo.png') }}">
  <link rel="preconnect" href="https://fonts.gstatic.com" />

  <!-- Font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

  <script src="{{ asset(mix('js/app.js')) }}" defer></script>
</head>

<body>
  <noscript>
    <strong>We're sorry but RRHH ERP2 doesn't work properly without JavaScript enabled.
      Please enable it to continue.</strong>
  </noscript>

  <div id="app">
  </div>
</body>

</html>
