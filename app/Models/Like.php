<?php

namespace App\Models;

use App\Jobs\DisLikeJob;
use App\Jobs\ExampleJob;
use App\Jobs\LikeJob;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
      use HasFactory;

      protected $guarded = [];

      public function likeable()
      {
            return $this->morphTo();
      }

      public function doLike($car, $value)
      {
            $user = auth()->user()->id;

            if ($value == 1) {
                  dispatch(new LikeJob($car, $user));
            } else {
                  dispatch(new DisLikeJob($car, $user));
            }
      }
}
