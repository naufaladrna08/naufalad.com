@extends('components.layout')

@section('content')
  <div class="container">
    <h5 class="text-center my-4"> My Videos </h5>
  
    <div class="row">
      @for ($i = count($data) - 1; $i > 0; $i--)
        <div class="col-sm-12 col-md-4 col-lg-3">
          <div class="card my-2" style="width: 100%; height: 440px">
            <img class="card-img-top" src="{{ $data[$i]->snippet->thumbnails->medium->url }}" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title" style="height: 68px"> {{ $data[$i]->snippet->title }} </h5>
              <p class="card-text" style="height: 128px"> 
                <?php
                if (strlen($data[$i]->snippet->description) > 200) {
                  echo mb_substr($data[$i]->snippet->description, 0, 200) . '...';
                } else {
                  echo $data[$i]->snippet->description;
                }
                ?>
              </p>
              <a href="https://youtube.com/watch?v={{ $data[$i]->id->videoId }}" class="btn btn-primary btn-block w-100"> Go To Video </a>
            </div>
          </div>
        </div>
      @endfor
    </div>
    
  </div>
@endsection