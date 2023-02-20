<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Article extends Model {
  use HasFactory;

  protected $fillable = [
    'uid',
    'title',
    'content',
    'category',
    'is_active'
  ];

  public function category() : HasOne {
    return $this->hasOne(Category::class, 'id', 'category_id');
  }

  public function author() : HasOne {
    return $this->hasOne(User::class, 'id', 'uid');
  }

  public function tags() : HasMany {
    return $this->hasMany(TagRelation::class, 'article_id', 'id');
  }
}
