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

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\Api\AuthController;

Route::get('/', [GuestController::class, 'index']);
Route::get('/blog', [GuestController::class, 'blog'])->name('guest.blog');
Route::get('/youtube', [GuestController::class, 'youtube'])->name('guest.youtube');
Route::get('/projects', [ProjectController::class, 'index']);
Route::get('/contacts', [ContactController::class, 'index']);
Route::get('/blog', [GuestController::class, 'getBlogs'])->name('guest.blog');
Route::get('/blog/{data}', [GuestController::class, 'blog'])->name('guest.blogid');
Route::get('/nae', [\App\Http\Controllers\Nae::class, 'index']);

/* Hard-coded projects */
Route::get('/projects/tridme-engine', [ProjectController::class, 'tridmeengine']);
Route::get('/projects/inos', [ProjectController::class, 'inos']);
Route::get('/projects/jin', [ProjectController::class, 'jin']);
Route::get('/projects/visual-students', [ProjectController::class, 'visualstudents']);

Route::group(['middleware' => 'auth.admin'], function() {
  Route::get('/admin', [AdminController::class, 'index']);
  Route::post('/admn_login', [AuthController::class, 'login'])->name('admin.login');
});

Route::group(['middleware' => 'auth.adminonly'], function() {
  Route::get('/post', [AdminController::class, 'create_article'])->name('admin.post');
  Route::get('/post/{id}', [AdminController::class, 'create_article'])->name('admin.post');
  Route::get('/drafts', [AdminController::class, 'drafts'])->name('admin.post');
  Route::post('/apost', [AdminController::class, 'apost'])->name('admin.post');
  Route::post('/upld_image', [AdminController::class, 'upload_image'])->name('upld.image');
  Route::get('/get-tags', [AdminController::class, 'getTags']);
  Route::get('/logout', [AdminController::class, 'logout']);
});