<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description"
    content="Himpunan Mahasiswa Informatika SMI Malang - organisasi pengembangan teknologi, inovasi, dan komunitas mahasiswa." />
  <meta name="keywords" content="HMIF, SMI Malang, mahasiswa informatika, organisasi, teknologi, komunitas" />
  
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Favicons -->
  <link href="/assets/img/logo_hmif.jpg" rel="icon" />
  <link href="/assets/img/logo_hmif.jpg" rel="apple-touch-icon" />

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect" />
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
    rel="stylesheet" />

  <link href="/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet" />

  <title inertia>HMIF SMI Malang</title>
  @vite('resources/js/app.js')
  @routes
</head>
<body>
  @inertia

  <script src="/assets/vendor/jquery/jquery.min.js"></script>
  <script src="/assets/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script>
    window.$ = window.jQuery = jQuery;
  </script>
</body>
</html>
