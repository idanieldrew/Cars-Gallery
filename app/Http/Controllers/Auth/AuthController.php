<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use http\Cookie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function register(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return response()->json(['user' => $user], 201);
    }


    /**
     * Get a JWT via given credentials.
     *
     * @param  Request  $request
     * @return Response
     */
    public function login(Request $request)
    {
        //validate incoming request
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
        $credentials = $request->only(['email', 'password']);

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        setcookie('x-access-token',$token,14400,null,null,false,true);
//        request()->cookie('t',$token);

        return $this->respondWithToken($token);
    }

    public function refresh()
    {
        $refreshToken = request()->cookie('x-access-token');

        $refreshToken ?null : abort(403,'token is expired!!!');

       return $this->respondWithToken($refreshToken);
    }

    //Add this method to the Controller class
    protected function respondWithToken($token)
    {
        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Carbon::now()->addDays(60)->timestamp
        ], 200);
    }
}
