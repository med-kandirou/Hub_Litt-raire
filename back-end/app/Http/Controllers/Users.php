<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



class Users extends Controller
{
   
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required'],
            'pass' => 'required',
        ]);
        if($validator->fails()){
            $response=[
                'success'=>'fail',
                'message'=>$validator->errors()
            ];
            return $response;
        }
        else{
            return 'ekt';
        }
    }

    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom'=>'required',
            'prenom'=>'required',
            'email' => ['required','email'],
            'password' => 'required',
            'Confirmation'=>'required|some:password'
        ]);
        if($validator->fails()){
            $response=[
                'success'=>'fail',
                'message'=>$validator->errors()
            ];
            return $response;
        }
        else{
            return 'ekt';
        }
    }
}
