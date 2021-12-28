<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('articles', function (Blueprint $table) {
      $table->id();
      $table->integer('uid');
      $table->string('title');
      $table->string('content');
      $table->string('categories');
      $table->boolean('is_active');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('articles');
  }

  public function uid() {
    return $this->belongsTo(User::class, 'foreign_key', 'owner_key');
  }
}
