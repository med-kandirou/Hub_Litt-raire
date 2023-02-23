<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Cloudinary\Api\ApiUtils;
use Cloudinary\Configuration\CloudConfig;
use App\Models\Livre;

// require_once '../../../vendor/autoload.php';


class livres extends Controller
{
    public function getsignature(){

        $cloudinaryConfig = new CloudConfig([
            "cloud_name" => "dxn7gskyn",
            "api_key" => "296547854239657",
            "api_secret" => "ikkwQSDc0p6WlyFvidFN36H0Ecw"
        ]);
        $timestamp=time();
        $params =
            [
                "timestamp" => time(),
                "folder" => 'books'
            ];
        
        $data = ['signature' => ApiUtils::signParameters($params, $cloudinaryConfig->apiSecret), 'timestamp' => $timestamp];
        return $data;
    }




    public function addLivre(Request $request)
    {
        $livre =new Livre();
        $livre->nom=$request->nom;
        $livre->image=$request->image;
        $livre->pdf=$request->file;
        $livre->isArchived=0;
        $livre->id_cat=$request->id_cat;
        $livre->created_at=date("Y-m-d");
        $livre->save();
        return 'added';
    }

    function supprimerLivre(Livre $livre){
        $livre->isArchived=1;
        $livre->update();
        return 'deleted';
    }
}
