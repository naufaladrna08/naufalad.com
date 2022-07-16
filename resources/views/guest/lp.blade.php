@extends('components.layout')

@section('content')
  <div id="root" class="d-flex text-center text-white bg-dark">
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
      <header>
        <div>
          <h3 class="float-md-start mb-0"> Naufal Adriansyah </h3>
          <nav class="nav nav-masthead justify-content-center float-md-end">
            <a class="nav-link active" href="#"> Home </a>
            <a class="nav-link" href="projects.html"> Projects </a>
            <a class="nav-link" href="contact.html"> Contact </a>
          </nav>
        </div>
      </header>

      <main class="main my-4">
        <h1 style="font-weight: 1000;"> この Naufal Adriansyah には… 夢がある!!! </h1>
        <p class="lead">
         <b class="sunda"> ᮞᮃᮙ᮪ᮕᮥᮛᮃᮞᮥᮔ᮪!!! </b> Hallo, nama saya Naufal Adriansyah. Programmer di PT. Cybers Blitz Nusantara. Lahir di Purwakarta, 13 Juli 2003. Saya suka membuat sesuatu.
        </p>

        <p class="lead">
          <a class="btn bg-white" href="{{ url('/blog') }}"> Blog </a>
          <a class="btn btn-danger" href="{{ url('/youtube') }}"> Youtube </a>
        </p>

        <footer class="footer text-white-50">
          <p> Naufal Adriansyah 💙 Open Source | 2022 </p>
        </footer>
      </main>
    </div>
  </div>

  <style>
    #root {
      text-shadow: 0 .05rem .1rem rgba(0, 0, 0, .5);
      box-shadow: inset 0 0 5rem rgba(0, 0, 0, .5);
      background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.8)), url("{{ asset('naufal.jpeg') }}");
      background-size: cover;
    }

    .footer {
      margin-top: 8em;
    }

    .cover-container {
      max-width: 42em;
    }

    .main {
      padding: 8em 0;
      height: 100vh;
    }
  </style>
@endsection