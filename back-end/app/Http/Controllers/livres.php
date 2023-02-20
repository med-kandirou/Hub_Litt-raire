<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Cloudinary\Api\ApiUtils;
use Cloudinary\Configuration\CloudConfig;
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
       $file=$request->file('file');
       return $file->getClientOriginalName();
    }
}
