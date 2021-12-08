<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Client\Request;

class EmailVerificationController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = User::find($request->route('id'));

        if($user->hasVerifiedEmail()){
            return redirect(env('client').'/verify');
        }
        if($user->markEmailAsVerified()){
            //event
        }
        return redirect('/');
    }
    public function verify($user_id, Request $request)
    {
        if (!$request->hasValidSignature()) {
            return 847;
        }

        $user = User::findOrFail($user_id);

        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }

        return redirect()->to('/');
    }
}
