<?php

namespace Modules\admin\app\Observer;

use Illuminate\Support\Str;

trait CategoryObserver
{
    protected static function Boot()
    {
        parent::boot();

        static::creating(function ($category){
            $category->slug = Str::slug($category->name);
        });
    }
}