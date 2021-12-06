<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\admin\app\Observer\CarObserver;

class Car extends Model
{
      use HasFactory,CarObserver;

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
            return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
      }
}
