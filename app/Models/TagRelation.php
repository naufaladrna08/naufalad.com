<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TagRelation extends Model {
  use HasFactory;

  public function tag() : HasOne {
    return $this->hasOne(Tag::class, 'id', 'tag_id');
  }
}
