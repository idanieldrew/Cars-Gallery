<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Events\UserEvent;
use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        // send mail
        event(new UserEvent($user));

        return response()->json(['user' => $user], 201);
    }

    /**
     * login  via JWT given credentials.
     *
     * @param  Request  $request
     * @return
     */
    public function login(Request $request)
    {
        $field = 'username';
        if (is_numeric($request->login)){
            $field = 'phone';
        } elseif (filter_var($request->login,FILTER_VALIDATE_EMAIL)){
            $field = 'email';
        }
        $request->merge([$field => $request->login]);

        $credentials = $request->only([$field, 'password']);

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    public function logout()
    {
        auth()->logout();

        return response()->json([
            'message' => 'logout!'
        ]);
    }

    //Add this method to the Controllers class
    protected function respondWithToken($token)
    {
        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Carbon::now()->addDays(60)->timestamp
        ], 200);
    }
}
