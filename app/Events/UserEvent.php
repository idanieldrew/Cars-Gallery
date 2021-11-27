<?php

namespace App\Events;

class UserEvent extends Event
{
    protected $user;

    public function __construct($user)
    {
        $this->user = $user;
    }
}