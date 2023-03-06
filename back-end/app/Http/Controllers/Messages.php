<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class Messages extends Controller
{
    public function sendMessage(Request $request){
        $message=new Message();
        $message->id_group=$request->idgroup;
        $message->id_user=$request->iduser;
        $message->message=$request->message;
        $message->save();
    }

    public function getmessages($id){
        return Message::select('messages.message','users.nom','users.prenom','messages.id_user')
        ->join('users','users.id','messages.id_user')
        ->where('messages.id_group','=',$id)
        ->get();
    }


    
}
