<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;



class Users extends Controller
{
   
    public function login(Request $request)
    {
        $user = DB::table('Users')->where('email',$request->input('email'))->where('password',$request->input('password'))->first();
        $response=[
            'user'=>$user
        ];
        return $response;
    }

    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom'=>'required',
            'prenom'=>'required',
            'email' => ['required','email'],
            'password' => 'required',
            'confirmation'=>'required|same:password'
        ]);
        if($validator->fails()){
            $response=[
                'success'=>'fail',
                'message'=>$validator->errors()
            ];
            return $response;
        }
        else{
            $user=new User();
            $user->nom=$request->input('nom');
            $user->prenom=$request->input('prenom');
            $user->email=$request->input('email');
            $user->password=$request->input('password');
            $user->role=0;
            $user->save();
            return 'inserted';
        }
    }

    public function supprimerCompte(Request $request)
    {
       $user=User::find($request->id);
       $user->delete();
       return 'deleted';
    }

    public function modifierCompte(Request $request,$id)
    {
       $user=User::find($id);
       $user->nom=$request->input('nom');
       $user->prenom=$request->input('prenom');
       $user->email=$request->input('email');
       $user->password=$request->input('password');
       $user->save();
       return ['etat'=>'updated'];
    }

}
