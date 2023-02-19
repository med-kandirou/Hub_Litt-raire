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

    public function addCat(Request $request)
    {
        $categorie=new Categorie();
        $categorie->nom=$request->input("nom");
        $categorie->save();
        return "added";
    }
    public function modifierCat($id,Request $request)
    {
        $categorie=categorie::find($id);
        $categorie->nom=$request->input("nom");
        $categorie->update();
        return 'updated';
    }

}
