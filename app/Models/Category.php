<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function cars()
    {
        return $this->hasMany(Car::class);
    }


    public function comments()
    {
          return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }
}
