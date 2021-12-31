@extends('components.layout')

@section('content')
  <div class="container" id="wrap-all">
    @if (Route::is('guest.blog'))
    <div class="row">
      <div class="col-md-2 d-none d-sm-block">
        <h5> My Open Source Projects </h5>
        
        <div id="projects" class="loading mb-2" style="height: 64px;"></div>
        <div id="projects" class="loading mb-2" style="height: 64px;"></div>
        <div id="projects" class="loading mb-2" style="height: 64px;"></div>
      </div>
      <div class="col-md-8">
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
      </div>
      <div class="col-md-2">
        <div id="ads">
          <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2367790008504793"
              crossorigin="anonymous"></script>
          <!-- Sidebar -->
          <ins class="adsbygoogle"
              style="display:block"
              data-ad-client="ca-pub-2367790008504793"
              data-ad-slot="5548968903"
              data-ad-format="auto"
              data-full-width-responsive="true"></ins>
          <script>
              (adsbygoogle = window.adsbygoogle || []).push({});
          </script>
        </div>
      </div>
    </div>
    @else 
    <div class="row">
      <div class="col-md-10">
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

          <div id="ads">
            <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2367790008504793"
                crossorigin="anonymous"></script>
            <!-- End -->
            <ins class="adsbygoogle"
                style="display:block"
                data-ad-client="ca-pub-2367790008504793"
                data-ad-slot="3160794503"
                data-ad-format="auto"
                data-full-width-responsive="true"></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
          </div>
        </div>
      </div>
      <div class="col-md-2">
        <div id="ads">
          <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2367790008504793"
              crossorigin="anonymous"></script>
          <!-- Sidebar -->
          <ins class="adsbygoogle"
              style="display:block"
              data-ad-client="ca-pub-2367790008504793"
              data-ad-slot="5548968903"
              data-ad-format="auto"
              data-full-width-responsive="true"></ins>
          <script>
              (adsbygoogle = window.adsbygoogle || []).push({});
          </script>
        </div>
      </div>
    </div>    
    @endif
  </div>
@endsection