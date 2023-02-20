<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\categorie;

class admin extends Controller
{
    public function getUsers()
    {
      return json_encode(User::select('nom','prenom','email', 'created_at','updated_at')->where('role', 0)->get());
    }
    public function getCats()
    {
      return categorie::all();
    }
}
