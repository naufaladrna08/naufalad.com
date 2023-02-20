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
    return view('guest.lp');
  }

  public function blog($data = null) {
    $model = null;
    
    if ($data == null) {
      $model = Article::where('is_active', true)
        ->where('is_active', true)
        ->orderBy('created_at', 'desc')
        ->get();

    } else {
      if (is_numeric($data)) {
        $model = Article::where('is_active', true)
          ->where('is_active', true)
          ->where('articles.id', $data)
          ->first();
      } else {
        $model = Article::where('is_active', true)
          ->where('is_active', true)
          ->whereRaw('articles.title = ?', [strtolower(str_replace('-', ' ', $data))])
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
      'isLoggedIn' => $isLoggedIn
    ]);
  }

  public function youtube() {
    $data = Youtube::listChannelVideos('UCTQgfds5fJArXxWUwl-VqBg', 40);

    return view('guest.youtube', [
      'data' => $data
    ]);
  }
}
