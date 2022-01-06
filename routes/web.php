<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Guest;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\Admin;
use App\Http\Controllers\Api\AuthController;

Route::get('/', [Guest::class, 'index']);
Route::get('/blog', [Guest::class, 'blog'])->name('guest.blog');
Route::get('/blog/{data}', [Guest::class, 'blog'])->name('guest.blogid');

Route::get('/logout', [AuthController::class, 'logout']);

Route::group(['middleware' => 'auth.admin'], function() {
  Route::get('/admin', [Admin::class, 'index']);
  Route::post('/admn_login', [AuthController::class, 'login'])->name('admin.login');
});

Route::group(['middleware' => 'auth.adminonly'], function() {
  Route::get('/post', [Admin::class, 'create_article'])->name('admin.post');
  Route::get('/drafts', [Admin::class, 'drafts'])->name('admin.post');
  Route::post('/apost', [Admin::class, 'apost'])->name('admin.post');
  Route::post('/upld_image', [Admin::class, 'upload_image'])->name('upld.image');
  Route::post('/get_categories', [Admin::class, 'get_categories']);
});