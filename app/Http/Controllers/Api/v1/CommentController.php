<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Jobs\CreateCommentJob;
use App\Jobs\CreateReplyJob;
use App\Models\Car;
use App\Models\Comment;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::all();
        return $comments;
    }

      public function store($car, Comment $comment)
      {
            $car = Car::where('slug', $car)->firstOrFail();

            $comment->addComment($car, request()->content);

            return response()->json([
                  'success' => true,
                  'message' => request()->content
            ], 201);
      }


      public function comment($car, Comment $comment)
      {
            $car = Car::where('slug', $car)->firstOrFail();

            $comment->when(
                  request()->reply,
                  function () use ($car) {
                        dispatch(new CreateReplyJob($car, 1, request()->all()));
                  },
                  function () use ($car) {
                        dispatch(new CreateCommentJob($car, 1, request()->content));
                  }
            );

            return response()->json([
                  'success' => true,
                  'message' => request()->content
            ], 201);
      }
}
