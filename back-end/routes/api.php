<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users;
use App\Http\Controllers\admin;
use App\Http\Controllers\categories;
use App\Http\Controllers\groupes;
use App\Http\Controllers\livres;

// use App\Http\Controllers\;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


//user
Route::post('/login', [Users::class, 'login']);
Route::post('/signup', [Users::class, 'signup']);
Route::delete('/user/supprimerCompte', [Users::class, 'supprimerCompte']);
Route::put('/user/modifierCompte/{id}', [Users::class, 'modifierCompte']);



//admin
Route::get('/admin/getUsers', [admin::class, 'getUsers']);
Route::get('/admin/getCats', [admin::class, 'getCats']);
Route::get('/admin/getLivres', [admin::class, 'getLivres']);


//categories
Route::delete('/categorie/supprimerCat/{id}', [categories::class, 'supprimerCat']);
Route::post('/categorie/addCat', [categories::class, 'addCat']);
Route::patch('/categorie/modifierCat/{id}', [categories::class, 'modifierCat']);

//groupes
Route::get('/groupe/getGroups', [groupes::class, 'getGroups']);



//livre
Route::post('/livre/addLivre', [livres::class, 'addLivre']);



Route::get('/livre/getsignature', [livres::class, 'getsignature']);
