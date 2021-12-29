<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Guest extends Controller {
  public function index() {
    return view('guest.lp');
  }

  public function blog() {
    $model = DB::table('articles')
      ->select('users.username', 'articles.*')
      ->leftJoin('users', 'users.id', '=', 'articles.uid')
      ->where('is_active', true)
      ->get();

    return view('guest.blog', [
      'data' => $model
    ]);
  }
}
