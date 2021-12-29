@extends('components.layout')

@section('content')
  <div class="container my-4">
    @foreach ($data as $d)
      <p>{{ $d->content }}</p>
    @endforeach
  </div>
@endsection