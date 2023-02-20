@extends('components.layout')

@section('content')
  <div class="container" id="wrap-all">
    @if (Route::is('guest.blog'))
    <div class="row">
      <div class="col-md-2 d-none d-sm-block">
      </div>
      <div class="col-md-8">
        <div class="input-group mb-3">
          <span class="input-group-text" id="basic-addon1"> <i class="fas fa-search"> </i> </span>
          <input type="text" class="form-control" placeholder="Search article" aria-label="search" id="search">
        </div>

      @if ($isLoggedIn == true)
        <div class="d-flex flex-row bd-highlight mb-4">
          <a href="{{ url('post') }}" class="btn btn-primary btn-sm mx-2 flex-fill"> Create an Article </a>
          <a href="{{ url('drafts') }}" class="btn btn-secondary btn-sm mx-2 flex-fill"> Drafts </a>
        </div>
      @endif

      @foreach ($data as $d)
        <div class="wrap-content mb-4">
          <h1> {{ $d->title }} </h1>
          By {{ $d->username }}, {{ \App\Classes\Helpers::timeElapsedString($d->created_at) }}
          <p class="lead mt-4">
            <?php
            if (strlen($d->content) > 255) {
              echo mb_substr($d->content, 0, 255) . '... <br> <br> <span class="badge bg-primary link" onclick="document.location.href = \''. url('blog/' . strtolower(str_replace(' ', '-', $d->title))) .'\'"> Continue Reading </span>';
            } else {
              echo $d->content;
            }
            ?>
          </p>

          <div class="my-4">
            <h6>
              Categories:
              <?php
              $model = DB::table('categories')
                ->whereIn('id', explode('/', $d->categories))
                ->get();

              foreach ($model as $dt) {
                echo '<span class="badge bg-secondary" style="margin-right: 2px;">' . $dt->category . '</span>';
              }
              ?>
            </h6>
          </div>
        </div>
      @endforeach
      </div>
    </div>
    @else

    @section('title', 'Naufal Adriansyah - ' . $data->title)
    @section('description', mb_substr($data->content, 0, 255) . '...')
    
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-sm-12 col-md-8">
        <div class="wrap-content mb-4">
          <h1> {{ $data->title }} </h1>
          By {{ $data->username }}, {{ \App\Classes\Helpers::timeElapsedString($data->created_at) }}
          <p class="lead mt-4">
            {!! $data->content !!}
          </p>
    
          <div class="my-4">
            <h6>
              Categories:
              <?php
              $keywords = '';
              $model = DB::table('categories')
                ->whereIn('id', explode('/', $data->categories))
                ->get();
    
              foreach ($model as $dt) {
                echo '<span class="badge bg-secondary" style="margin-right: 2px;">' . $dt->category . '</span>';
                $keywords .= $dt->category . ',';
              }
              ?>

              @section('keywords', $keywords)
            </h6>
          </div>
        </div>
      </div>
      <div class="col-md-2"></div>
    </div>    
    @endif
  </div>
@endsection