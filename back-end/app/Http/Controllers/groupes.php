<?php

namespace App\Http\Controllers;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class groupes extends Controller
{
    public function getGroups()
    {
        $groupes = Group::select('groups.id','groups.nom','groups.description','Users.nom AS nom_user','groups.created_at')->join('Users', 'Users.id', '=', 'groups.id_user')->get();
        return $groupes;
    }
}
