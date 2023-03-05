<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Membre;

class Membres extends Controller
{
    public function getMembres($idgroup){
        return Membre::select('users.nom','users.prenom','users.email')
        ->join('users', 'users.id','=','membres.id_user')
        ->where('membres.id_group','=',$idgroup)
        ->get();
    }
}
