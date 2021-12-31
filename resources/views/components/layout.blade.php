<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title> Naufal Adriansyah </title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Fuzzy+Bubbles&family=Mochiy+Pop+One&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  
  <meta name="title" content="Naufal Adriansyah - Blog">
  <meta name="description" content="Naufal Adriansyah adalah orang biasa yang suka main gitar dan coding."/>
  <meta name="keyword" content="Naufal Adriansyah,Naufal,naufal adriansyah, naufal">
  <meta name="author" content="Naufal Adriansyah">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Google Adsense -->
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2367790008504793" crossorigin="anonymous"></script>

  <!-- Facebook -->
  <meta name="facebook-domain-verification" content="pkntmhf84pwxeolc4hv59fz5zlp1nj" />
</head>
<body>
  @if (Route::is('guest.blog'))
  <nav class="navbar navbar-expand fixed-top navbar-light bg-light">
    <div class="container">
      <a class="navbar-brand" href="{{ url('/') }}"> Naufal Adriansyah </a>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link bg-primary text-white active" aria-current="page" href="{{ url('/') }}">Back to Home</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  @elseif (Route::is('guest.blogid'))
  <nav class="navbar navbar-expand fixed-top navbar-light bg-light">
    <div class="container">
      <a class="navbar-brand" href="{{ url('/') }}"> Naufal Adriansyah </a>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link bg-primary text-white active" aria-current="page" href="{{ url('/blog') }}">Back to Blogs</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  @endif

  @yield('content')

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  @stack('script')
</body>
</html>