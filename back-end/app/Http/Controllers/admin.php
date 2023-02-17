<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class admin extends Controller
{
    public function getUsers()
    {
      return User::select('nom','prenom','email', 'created_at','updated_at')->where('role', 0)->get();
    }
}
