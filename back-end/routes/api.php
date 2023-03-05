<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users;
use App\Http\Controllers\admin;
use App\Http\Controllers\categories;
use App\Http\Controllers\groupes;
use App\Http\Controllers\livres;
use App\Http\Controllers\Membres;
use App\Http\Controllers\Messages;

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
Route::post('/user/ajouterFavorie', [Users::class, 'ajouterFavorie']);
Route::get('/user/getFavories/{id}', [Users::class, 'getFavories']);
Route::get('/user/mesGroupes/{id}', [Users::class, 'mesGroupes']);
Route::delete('/user/supprimerFavorie/{id}', [Users::class, 'supprimerFavorie']);
Route::delete('/user/supprimerMongroup/{group}', [Users::class, 'supprimerMongroup']);
Route::post('/user/rejoindreGroup', [Users::class, 'rejoindreGroup']);
Route::get('/user/getLivrebyDate/{date}', [Users::class, 'getLivrebyDate']);
Route::get('/user/getLivrebyCat/{cat}', [Users::class, 'getLivrebyCat']);
Route::get('/user/getLivrebyNom/{nom}', [Users::class, 'getLivrebyNom']);
Route::get('/user/getLivres/{id}', [Users::class, 'getLivres']);
Route::get('/user/getGroups/{id}', [Users::class, 'getGroups']);


Route::patch('/user/like', [Users::class, 'like']);
Route::patch('/user/dislike', [Users::class, 'dislike']);
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
Route::post('/groupe/creerUngroupe', [groupes::class, 'creerUngroupe']);


//livre
Route::get('/livre/getsignature', [livres::class, 'getsignature']);
Route::post('/livre/addLivre', [livres::class, 'addLivre']);
Route::get('/livre/getlivre/{id}', [livres::class, 'getlivre']);
Route::patch('/livre/supprimerLivre/{livre}', [livres::class, 'supprimerLivre']);
Route::post('/livre/updateLivre', [Livres::class, 'updateLivre']);


//membres
Route::get('/membres/{id}', [Membres::class, 'getMembres']);


//livres
Route::post('/messages', [Messages::class, 'sendMessage']);
Route::get('/messages/{id}', [Messages::class, 'getmessages']);