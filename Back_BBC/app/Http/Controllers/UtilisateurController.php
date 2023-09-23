<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUtilisateurRequest;
use App\Http\Requests\UpdateUtilisateurRequest;
use Illuminate\Http\Request;
use App\Models\Utilisateur;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Support\Facades\DB;


class UtilisateurController extends Controller
{
    // public function __construct()
    // {
    //     $this->authorizeResource(Utilisateur::class);
    // }

    /**
     * Display a listing of the resource.
     */


    // public function loginUtilisateur(Request $request)
    // {
    //     try {
    //         $validateUser = Validator::make($request->only(['login', 'password']), [
    //             'login' => 'required',
    //             'password' => 'required'
    //         ]);

    //         if ($validateUser->fails()) {
    //             return response()->json([
    //                 'status' => false,
    //                 'message' => $validateUser->errors()
    //             ], 400);
    //         }

    //         $user = Utilisateur::where('login', $request->login)->first();

    //         if (!$user || !password_verify($request->password, $user->password)) {
    //             return response()->json([
    //                 'status' => false,
    //                 'message' => 'Login & Password do not match with our records'
    //             ], 401);
    //         }

    //         return response()->json([
    //             'status' => true,
    //             'message' => 'Utilisateur logged in successfully',
    //             'token' => $user->createToken("API TOKEN")->plainTextToken
    //         ]);
    //     } catch (\Throwable $th) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => $th->getMessage()
    //         ], 500);
    //     }
    // }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createUtilisateur(StoreUtilisateurRequest $request)
    {
       // dd (auth()->user()->can('create', User::class));

        // $this->authorize('create', Utilisateur::class);
        // dd(auth()->user()->role);

        try {
            
            $user = Utilisateur::create([
                'nomComplet' => $request->validated()['nomComplet'],
                'login' => $request->validated()['login'],
                'password' => $request->validated()['password'],
                'telephone' => $request->validated()['telephone'],
                'role' => $request->validated()['role'],
                'adresse' => $request->validated()['adresse'],
                'succursale_id' => $request->validated()['succursale_id']
            ]);

            return response()->json([
                'status' => true,
                'message' => 'User create successfully',
                'user' => $user,
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);

        } catch (\Throwable $th) {
            return response()->json(
                [
                    'status' => false,
                    'message' => $th->getMessage(),
                ], 500
            );
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUtilisateurRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Utilisateur $utilisateur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Utilisateur $utilisateur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUtilisateurRequest $request, Utilisateur $utilisateur)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Utilisateur $utilisateur)
    {
        //
    }
}
