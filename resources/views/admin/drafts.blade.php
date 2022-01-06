@extends('components.layout')

@section('content')
  <div class="container" id="wrap-all">
    <h1> Select article </h1>
    <ul>
    @foreach ($data as $d)
      <li> <a href="{{ url('post/' . $d->id) }}"> {{ $d->title }} </a> </li>
    @endforeach
    </ul>
  </div>
@endsection

@push('script')
  <script>
    $(document).ready(() => {

    })
  </script>
@endpush