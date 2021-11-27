<?php

namespace App\Listeners;

use App\Events\UserEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserListener implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(UserEvent $event)
    {
        dd($event);
    }
}