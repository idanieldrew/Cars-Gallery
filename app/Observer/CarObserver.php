<?php

namespace App\Observer;

use Illuminate\Support\Str;

trait CarObserver
{
      protected static function Boot()
      {
            parent::boot();
            
            static::creating(function ($car){
                  $car->slug = Str::slug($car->name);
            });
      }      
}