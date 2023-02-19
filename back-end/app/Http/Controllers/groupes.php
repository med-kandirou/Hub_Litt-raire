<?php

namespace App\Http\Controllers;
use App\Models\Group;
use Illuminate\Http\Request;

class groupes extends Controller
{
    public function getGroups()
    {
        $groupes = Group::select('groups.id','groups.nom','groups.description','Users.nom')->join('Users', 'Users.id', '=', 'groups.id')->get();
        return $groupes;


        // $groupes =DB::table('groups')
        // ->join('users', 'users.id', '=', 'groups.id')
        // ->select('groups.nom','groups.description','users.nom')
        // ->get();
        // return $groupes;
    }
}