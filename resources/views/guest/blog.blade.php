@extends('components.layout')

@section('content')
  @foreach ($data as $d)
    <p>This is user {{ $d->content }}</p>
  @endforeach
@endsection