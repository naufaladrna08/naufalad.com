@extends('components.layout')

@section('content')
  <div id="root" class="d-flex text-center text-white bg-dark">
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
      @include('components.header')

      <main class="main my-4">
        <div class="text-center my-4">
          <img src="{{ asset('/images/gwe.jpeg') }}" class="img-thumbnail img-circle img-small" alt="Profile Photo">
        </div>
      
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
      background: #2b2b2b;
      background-size: cover;
    }

    .footer {
      margin-top: 8em;
    }

    .cover-container {
      max-width: 42em;
    }

    .main {
      padding: 2em 0;
      height: 100vh;
    }

    .img-circle {
      border-radius: 100%;
    }
    
    .img-small {
      width: 200px;
    }
  </style>
@endsection