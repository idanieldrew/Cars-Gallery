<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Mail\Mailable;

class RegisterUser extends Mailable
{
    protected $user;

    public function __construct(User $user)
    {
            $this->user = $user;
    }

    public function build()
    {
        return $this->with(['name' => $this->user->name]);
    }
}