<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class);
    }

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

    public function logout(Request $request)
    {
        Auth::guard('sanctum')->user()->tokens()->delete();
        Cookie::forget("token");

        return response()->json([
            'message' => 'Déconnecté avec succès'
        ]);
    }

    public function createUser(StoreUserRequest $request)
    {
        $this->authorize('create', User::class);
       // dd(auth()->user()->role);
       // dd (auth()->user()->can('create', User::class));
        try {
            
            $user = User::create([
                'name' => $request->validated()['name'],
                'email' => $request->validated()['email'],
                'password' => $request->validated()['password'],
                'role' => $request->validated()['role']
            ]);

            return response()->json([
                'status' => true,
                'message' => 'User create successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], Response::HTTP_CREATED);

        } catch (\Throwable $th) {
            return response()->json(
                [
                    'status' => false,
                    'message' => $th->getMessage(),
                ], 500
            );
        }
    }

    public function deleteUser($userId)
    {
        $this->authorize('delete', User::class);

        $user = User::findOrFail($userId);
        $user->delete();
        return response()->json([
            'status' => true,
            'message' => 'User supprimé avec succès',
            'user' => $user
        ]);
    }


}
