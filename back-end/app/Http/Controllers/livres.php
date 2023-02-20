<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class livres extends Controller
{
    public function addLivre(Request $request)
    {
       $file=$request->file('file');
       return $file->getClientOriginalName();
    }
}
