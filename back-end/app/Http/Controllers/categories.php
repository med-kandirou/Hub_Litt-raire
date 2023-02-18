<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;

class categories extends Controller
{
    public function supprimerCat($id)
    {
       $categorie=categorie::find($id);
       $categorie->delete();
       return 'deleted';
    }
}
