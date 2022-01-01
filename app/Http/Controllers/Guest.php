<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;

class Guest extends Controller {
  public function index() {
    return view('guest.lp');
  }

  public function blog($data = null) {
    $model = null;
    
    if ($data == null) {
      $model = DB::table('articles')
        ->select('users.username', 'articles.*')
        ->leftJoin('users', 'users.id', '=', 'articles.uid')
        ->where('is_active', true)
        ->get();
    } else {
      if (is_numeric($data)) {
        $model = DB::table('articles')
          ->select('users.username', 'articles.*')
          ->leftJoin('users', 'users.id', '=', 'articles.uid')
          ->where('is_active', true)
          ->where('articles.id', $data)
          ->first();
      } else {
        $model = DB::table('articles')
          ->select('users.username', 'articles.*')
          ->leftJoin('users', 'users.id', '=', 'articles.uid')
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
}
