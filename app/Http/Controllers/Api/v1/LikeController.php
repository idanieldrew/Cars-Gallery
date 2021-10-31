<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;

use App\Models\Car;
use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
      public function like($car, Like $like, Request $request)
      {
            $car = Car::where('slug', $car)->firstOrFail();

            $like->doLike($car, $request->value);
      }
}
