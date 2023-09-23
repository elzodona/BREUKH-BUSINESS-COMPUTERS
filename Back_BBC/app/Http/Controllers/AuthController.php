<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
     public function loginUser(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(),
            [
                'email'=> 'required|email',
                'password'=> 'required'

            ]);

            if (!auth()->attempt($request->only(['email', 'password']))) {
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match'
                ], Response::HTTP_UNAUTHORIZED);
            }

            // $user = User::where('email', $request->email)->first();
            $user = Auth::user();
            $token = $user->createToken("API TOKEN")->plainTextToken;
            $cookie = cookie("token", $token, 24*60);

            return response()->json([
                'status' => true,
                'message' => 'User logged in succesfully',
                'token' => $token
            ])->withCookie($cookie);

        } catch (\Throwable $th) {
            return response()->json(
                [
                    'status' => false,
                    'message' => $th->getMessage(),
                ], Response::HTTP_UNAUTHORIZED
            );
        }
    }

    public function user(Request $request)
    {
        return $request->user();
    }

    public function logout(Request $request)
    {
        Auth::logout();
    }

}
