<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\User;
use App\Models\Article;
use App\Models\Draft;
use App\Models\Photo;
use App\Models\Category;

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

  public function create_article() {
    return view('admin.create_article');
  }

  public function apost(Request $r) {
    $type = $r->type;
    $data = [];

    if ($type == 'DRAFT') {
      $check = Draft::where('title', $r->data['title'])->first();
      
      $model = $check == null ? new Draft() : $check;
      $model->uid = Auth::user()->id;
      $model->title = $r->data['title'];
      $model->content = $r->data['content'];
      $model->categories = '1/2';
      $model->is_active = true;
      $model->created_at = date('Y-m-d H:i:s');
      $model->updated_at = date('Y-m-d H:i:s');

      if ($model->save()) {
        $data = [
          'code' => '200',
          'status' => 'Success',
          'message' => 'Data berhasil simpan'
        ];
      } else {
        $data = [
          'code' => '500',
          'status' => 'Failed',
          'message' => 'Data gagal simpan'
        ];
      }
    } else if ($type == 'FINAL') {
      $check = Article::where('title', $r->data['title'])->first();
      
      $model = $check == null ? new Article() : $check;
      $model->uid = Auth::user()->id;
      $model->title = $r->data['title'];
      $model->content = $r->data['content'];
      $model->categories = '1/2';
      $model->is_active = true;
      $model->created_at = date('Y-m-d H:i:s');
      $model->updated_at = date('Y-m-d H:i:s');

      if ($model->save()) {
        $data = [
          'code' => '200',
          'status' => 'Success',
          'message' => 'Data berhasil simpan'
        ];
      } else {
        $data = [
          'code' => '500',
          'status' => 'Failed',
          'message' => 'Data gagal simpan'
        ];
      }
    } else {
      $data = [
        'code' => '404',
        'status' => 'Failed',
        'message' => 'Tipe tidak ditemukan'
      ];
    }

    return response()->json($data);
  }

  public function upload_image(Request $r) {
    $name = null;

    if ($r->hasFile('file')) {
      $name = Auth::user()->id . '-' . time() . '.' . $r->file->extension();

      $r->file('file')->storeAs('images', $name);

      $model = new Photo;
      $model->uid = Auth::user()->id;
      $model->path = 'images/' . $name;
      $model->save();
    }

    return url('images/' . $name);
  }

  public function get_categories(Request $r) {
    $q = $r->q;
    $data = [];
    $dataall = Category::get();
    
    foreach ($dataall as $one) {
      $data["results"][] = [
        "id" => $one->id,
        "text" => $one->category
      ];
    }
    
    return response()->json($data);
  }
}
