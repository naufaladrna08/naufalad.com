<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDraftsTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('drafts', function (Blueprint $table) {
      $table->id();
      $table->integer('uid');
      $table->string('title');
      $table->text('content');
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
    Schema::dropIfExists('drafts');
  }
}
