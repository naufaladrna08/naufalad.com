<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Models\Article;

class Guest extends Controller {
  public function index() {
    return view('guest.lp');
  }

  public function blog() {
    $model = Article::all();

    return view('guest.blog', [
      'data' => $model
    ]);
  }
}
