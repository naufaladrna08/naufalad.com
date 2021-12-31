@extends('components.layout')

@section('content')
  <div class="container" id="wrap-all">
    @if (Route::is('guest.blog'))
      @foreach ($data as $d)
        <div class="wrap-content mb-4">
          <h1> {{ $d->title }} </h1>
          By {{ $d->username }} on {{ $d->created_at }}
          <p class="lead mt-4">
            <?php
            if (strlen($d->content) > 255) {
              echo mb_substr($d->content, 0, 255) . '<br> <br> <span class="badge bg-primary link" onclick="document.location.href = \''. url('blog/' . strtolower(str_replace(' ', '-', $d->title))) .'\'"> Continue Reading </span>';
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
    @else 
    <div class="wrap-content mb-4">
      <h1> {{ $data->title }} </h1>
      By {{ $data->username }} on {{ $data->created_at }}
      <p class="lead mt-4">
        {{ $data->content }}
      </p>

      <div class="my-4">
        <h6>
          Categories:
          <?php
          $model = DB::table('categories')
            ->whereIn('id', explode('/', $data->categories))
            ->get();

          foreach ($model as $dt) {
            echo '<span class="badge bg-secondary" style="margin-right: 2px;">' . $dt->category . '</span>';
          }
          ?>
        </h6>
      </div>
    </div>
    @endif
  </div>
@endsection