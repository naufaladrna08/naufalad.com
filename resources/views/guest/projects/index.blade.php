@extends('components.layout')

@section('content')
  <div id="root" class="d-flex text-center text-white bg-dark">
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
      @include('components.header')
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