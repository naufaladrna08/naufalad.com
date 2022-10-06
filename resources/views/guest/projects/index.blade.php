@extends('components.layout')

@section('content')
  <div id="root" class="d-flex text-center text-white bg-dark">
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
      @include('components.header')

      <div class="main my-4">
        <div class="text-center">
          <h4> {{ $parameter->name }} </h4>
          <p class="lead" style="margin-bottom: 8em;">
            {{ $parameter->description }}
          </p>

          <div class="row mt-4">
            @foreach ($projects as $project)
            <div class="col-sm-12 col-md-6 my-2" data-aos="fade-up">
              <div class="card-project">
                <img src="{{ asset('/static-images/' . $project->icon) }}" alt="Project" class="card-project-image">
                
                <div class="card-project-body">
                  <h4> {{ $project->name }} </h4>
                  <p class="lead">
                    {{ $project->shortdesc }}
                  </p>

                  <a href="/projects/{{ $project->code }}" class="btn btn-primary btn-sm"> Visit Project </a>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
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
      padding: 8em 0;
      height: 200vh;
    }

    .card-project {
      padding: 2em;
      background: #565656;
      text-align: center;
      border-radius: 16px;

      width: 100%;
      height: 100%;
    }

    .card-project-image {
      /* width: 64px; */
      height: 64px;
      margin-top: 16px;
      margin-bottom: 16px;
    }
  </style>
@endsection