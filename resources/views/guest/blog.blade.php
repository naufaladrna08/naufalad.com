@extends('components.layout')

@section('content')
  <div class="container my-4">
    @foreach ($data as $d)
      <div class="wrap-content mb-4">
        <h1> {{ $d->title }} </h1>
        By {{ $d->username }} on {{ $d->created_at }}
        <p class="lead mt-4">
          <?php
          if (strlen($d->content) > 255) {
            echo mb_substr($d->content, 0, 255) . '<br> <br> <span class="badge bg-primary link" onclick="document.location.href = \''. url('blog/' . $d->id) .'\'"> Continue Reading </span>';
          } else {
            echo $d->content;
          }
          ?>
        </p>

        {{-- <div class="mt-4">
          <h6>
            Categories:

          </h6>
        </div> --}}
      </div>
    @endforeach
  </div>
@endsection