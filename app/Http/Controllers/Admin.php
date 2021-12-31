<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class Admin extends Controller {
  public function index() {
    return view('admin.login');
  }

  public function create(Request $r) {
    $data = [];
    
    $user = new User;
    $user->name = $r->name;
    $user->username = $r->name;
    $user->email = $r->email;
    
    if ($user->save()) {
      $data = [
        'code' => '200',
        'status' => 'Success',
        'message' => 'Data dibuat',
        'data' => $user
      ];
    }

    return response()->json($data);
  }

  public function update(Request $r) {
    $data = [];
    $user = User::find()->where('username', $r->username)->first();
  
    $user->username = $r->username != null ? $r->username : $user->username;
    $user->email = $r->email != null ? $r->email : $user->email;

    if ($user->save()) {
      $data = [
        'code' => '200',
        'status' => 'Success',
        'message' => 'Data dibuat',
        'data' => $user
      ];
    }

    return response()->json($data);
  }
}
