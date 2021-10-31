<?php

namespace App\Models;

use App\Jobs\CreateCommentJob;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
      use HasFactory;

      protected $guarded = [];

      public function likes()
      {
            return $this->morphMany(Like::class, 'likeable');
      }

      public function user()
      {
            return $this->belongsTo(User::class);
      }

      public function addComment($car, $value)
      {
            dispatch(new CreateCommentJob($car, auth()->user()->id, $value));
      }
}
