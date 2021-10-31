<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;

use App\Models\Car;
use App\Models\Comment;

class CommentController extends Controller
{
      public function store($car, Comment $comment)
      {
            $car = Car::where('slug', $car)->firstOrFail();

            $comment->addComment($car, request()->content);

            return response()->json([
                  'success' => true,
                  'message' => request()->content
            ], 201);
      }
}
