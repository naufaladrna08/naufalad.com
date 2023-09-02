<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;
use App\Models\Article;

use Alaouy\Youtube\Facades\Youtube;

class GuestController extends Controller {
  public function index() {
    $isLoggedIn = null;

    if (Auth::check()) {
      $isLoggedIn = true;
    } else {
      $isLoggedIn = false;
    }

    return view('guest.lp', [
      'isLoggedIn' => $isLoggedIn
    ]);
  }

  public function getBlogs(Request $r) {
    $isLoggedIn = null;

    if (Auth::check()) {
      $isLoggedIn = true;
    } else {
      $isLoggedIn = false;
    }

    return view('guest.list-blog', [
      'isLoggedIn' => $isLoggedIn
    ]);
  }

  public function blog($data = null) {
    $model = null;
    $tags  = "";
    
    if ($data == null) {
      $model = Article::where('is_active', true)
        ->where('is_active', true)
        ->orderBy('created_at', 'desc')
        ->with('tags')
        ->get();

      $i = 0;
      
      foreach ($model->tags as $tag) {
        if ($i < $count - 1) {
          $tags .= $tag->tag->name . ", ";
        } else {
          $tags .= $tag->tag->name;
        }
        
        $i++;
      }
    
    } else {
      if (is_numeric($data)) {
        $model = Article::where('is_active', true)
          ->where('is_active', true)
          ->where('articles.id', $data)
          ->with('tags')
          ->first();
      } else {
        $model = Article::where('is_active', true)
          ->where('is_active', true)
          ->whereRaw('articles.title = ?', [strtolower(str_replace('-', ' ', $data))])
          ->with('tags')
          ->first();
      }
    }

    $isLoggedIn = null;

    if (Auth::check()) {
      $isLoggedIn = true;
    } else {
      $isLoggedIn = false;
    }

    return view('guest.blog', [
      'data' => $model,
      'isLoggedIn' => $isLoggedIn,
      'tags' => $tags
    ]);
  }

  public function youtube() {
    $data = Youtube::listChannelVideos('UCTQgfds5fJArXxWUwl-VqBg', 40);

    return view('guest.youtube', [
      'data' => $data
    ]);
  }

  public function getContents(Request $r) {
    $data = [];
    $search = $r->search;
    
    $model = Article::where('is_active', true)
        ->where('is_active', true)
        ->orderBy('created_at', 'desc')
        ->with('tags');

    if ($search != null) {
      $model = $model->where('title', 'like', '%'. $search .'%')->paginate(5);
    } else {
      $model = $model->paginate(5);
    }
    
    $model->through(function ($value) {
      $content = '';
      $timeElapsedString = \App\Classes\Helpers::timeElapsedString($value->created_at);

      if (strlen($value->content) > 255) {
        $content = mb_substr($value->content, 0, 255) . '... <br> <br> <span class="badge bg-primary link" onclick="document.location.href = \''. url('blog/' . strtolower(str_replace(' ', '-', $value->title))) .'\'"> Continue Reading </span>';
      } else {
        $content = $value->content;
      }

      $card = "
        <div class=\"wrap-content mb-4\">
          <h1> " . $value->title . " </h1>
          By " .  $value->author->username . ", " . $timeElapsedString . "
          <p class='lead mt-4'>
            ". $content ."
          </p>

          <div class='my-4'>
            <h6>
              Category: <span class='badge bg-secondary' style='margin-right: 2px;'> " . $value->category->category . " </span>
            </h6>
          </div>
        </div>  
      ";

      return $card;
    });

    return response()->json($model);
  }
}
