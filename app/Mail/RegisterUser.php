<?php

use App\Models\User;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

class RegisterUser extends Mailable
{
    protected $user;

    public function __construct(User $user)
    {
            $this->user = $user;
    }

    public function build()
    {
//        Mail::send(['text' => 'mail'],'')
    }
}