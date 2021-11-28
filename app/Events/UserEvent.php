<?php

namespace App\Events;

class UserEvent extends Event
{
    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }
}