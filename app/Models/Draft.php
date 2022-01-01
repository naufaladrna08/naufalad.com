<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Draft extends Model {
  use HasFactory;

  protected $fillable = [
    'uid',
    'title',
    'content',
    'categories',
    'is_active'
  ];
}
