@extends('components.layout')

@section('content')
  <div class="container" id="wrap-all">
    @section('title', 'Naufal Adriansyah - ' . $data->title)
    @section('description', mb_substr(strip_tags($data->content), 0, 255) . '...')
    @section('keywords', $tags)
    
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-sm-12 col-md-8">
        <div class="wrap-content mb-4">
          <h1> {{ $data->title }} </h1>
          By {{ $data->author->username }}, {{ \App\Classes\Helpers::timeElapsedString($data->created_at) }}
          <p class="lead mt-4">
            {!! $data->content !!}
          </p>
    
          <div class="my-4">
            <h6>
              Category: <span class="badge bg-primary" style="margin-right: 2px;"> {{ $data->category->category }} </span>
            </h6>
            <h6>
              Tags: 

              @foreach ($data->tags as $tag)
                <span class="badge bg-secondary" style="margin-right: 2px;"> {{ $tag->tag->name }} </span>
              @endforeach
            </h6>
          </div>
        </div>
      </div>
      <div class="col-md-2"></div>
    </div>
  </div>
@endsection