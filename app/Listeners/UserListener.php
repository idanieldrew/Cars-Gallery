<?php

namespace App\Listeners;

use App\Events\UserEvent;
use App\Mail\RegisterUser;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Message;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class UserListener implements ShouldQueue
{
    use InteractsWithQueue;

    public $queue = 'register';

    public $delay = 60;

    public function handle(UserEvent $event)
    {
        $name = $event->user->name;
        $email = $event->user->email;

        $mail = new RegisterUser($event->user);

        Mail::send([],['name' => $event->user->email],function (Message $message) use ($email,$name){
            $message->to($email)
                ->subject('Welcome to Cars-Gallery ' . $name);
        });
    }
}