<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AmiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UniteController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\SuccursaleController;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\CaracteristiquesController;
use App\Http\Controllers\MarqueController;
use App\Http\Controllers\CategorieController;




/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('auth/login', [UserController::class, 'loginUser']);

Route::post('auth/Utilisateur', [UtilisateurController::class, 'loginUtilisateur']);


Route::middleware('auth:sanctum')->group(function() {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('auth/logout', [UserController::class, 'logout']);
    Route::post('auth/register', [UserController::class, 'createUser']);
    Route::delete('auth/delete/{userId}', [UserController::class, 'deleteUser']);

    Route::post('addUtilisateur', [UtilisateurController::class, 'createUtilisateur']);

    // Route::post('prod', [ProduitController::class, 'store']);

});

Route::apiResource('/succ', SuccursaleController::class);

Route::apiResource('/prod', ProduitController::class);

Route::post('/prod/paginer', [ProduitController::class, 'paginer']);

Route::get('/search/{succId}/{code}', [ProduitController::class, 'searchProd']);

Route::apiResource('/caract', CaracteristiquesController::class);

Route::apiResource('/unite', UniteController::class);

Route::apiResource('/marque', MarqueController::class);

Route::apiResource('/categorie', CategorieController::class);

Route::apiResource('/comm', CommandeController::class);

Route::controller(AmiController::class)->prefix('/succ/{id}')->group(function(){
    Route::get('/friends', 'listeFriends');

    Route::get('/noFriends', 'listeNoFriends');

    Route::get('/waiting', 'listeWaitingFriends');
});

