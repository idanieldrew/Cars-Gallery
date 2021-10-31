<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
      use HasFactory;

      protected $guarded = [];

      public function Images()
      {
            return $this->hasMany(Image::class);
      }

      public function category()
      {
            return $this->belongsTo(Category::class);
      }

      public function likes()
      {
            return $this->morphMany(Like::class, 'likeable');
      }

      public function comments()
      {
            return $this->hasMany(Comment::class);
      }
}
