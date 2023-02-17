<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class admin extends Controller
{
    public function getUsers(Request $request)
    {
      return 'worked';
    }
}
