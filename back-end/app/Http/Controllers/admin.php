<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\categorie;
use App\Models\Livre;

class admin extends Controller
{
    public function getUsers()
    {
      return User::select('nom','prenom','email', 'created_at','updated_at')->where('role', 0)->get();
    }
    public function getCats()
    {
      return categorie::all();
    }

    public function getLivres()
    {
      return livre::select('livres.id','livres.nom AS nom_livre','livres.image','livres.pdf', 'livres.created_at','categories.nom AS nom_cat')
      ->join('categories', 'livres.id_cat','=','categories.id')
      ->where('livres.isArchived','=',0)
      ->get();
    }
    
}
