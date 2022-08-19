<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

class Nae extends Controller {
  public function index() {
    return view('nae.index');
  }
}
