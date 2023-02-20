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
use App\Models\Tag;

class AdminController extends Controller {
  public function index() {
    return view('admin.login');
  }

  public function drafts() {
    $model = Draft::where('is_active', true)->get();

    return view('admin.drafts', [
      'data' => $model
    ]);
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

  public function create_article($draft_id = null) {
    $model = null;
    $categories = Category::where('is_active', true)->get();

    if ($draft_id != null) {
      $model = Draft::where('is_active', true)
        ->where('id', $draft_id)
        ->first();
    }

    return view('admin.create_article', [
      'd' => $model,
      'categories' => $categories
    ]);
  }

  public function apost(Request $r) {
    $type = $r->type;
    $data = [];

    if ($type == 'DRAFT') {
      $categories = '';
      $check = Draft::where('title', $r->data['title'])->first();
      
      for ($idx = 0; $idx < count($r->data['category']); $idx++) {
        if ($idx == count($r->data['category']) - 1) {
          $categories .= $r->data['category'][$idx];
        } else {
          $categories .= $r->data['category'][$idx] . '/';
        }
      }

      $model = $check == null ? new Draft() : $check;
      $model->uid = Auth::user()->id;
      $model->title = $r->data['title'];
      $model->content = $r->data['content'];
      $model->categories = $categories;
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
      $categories = '';
      $check = Article::where('title', $r->data['title'])->first();

      for ($idx = 0; $idx < count($r->data['category']); $idx++) {
        if ($idx == count($r->data['category']) - 1) {
          $categories .= $r->data['category'][$idx];
        } else {
          $categories .= $r->data['category'][$idx] . '/';
        }
      }
      
      $model = $check == null ? new Article() : $check;
      $model->uid = Auth::user()->id;
      $model->title = $r->data['title'];
      $model->content = $r->data['content'];
      $model->categories = $categories;
      $model->is_active = true;
      $model->created_at = date('Y-m-d H:i:s');
      $model->updated_at = date('Y-m-d H:i:s');

      if ($model->save()) {

        if ($r->data['dr_id'] != '') {
          $model = Draft::where('id', $r->data['dr_id'])->first();
          $model->is_active = false;
          $model->save();
        }

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

  public function getTags(Request $r) {
    $q = $r->q;
    $data = [];
    $dataall = Tag::get();
    
    foreach ($dataall as $one) {
      $data["results"][] = [
        "id" => $one->id,
        "text" => $one->category
      ];
    }
    
    return response()->json($data);
  }
}
