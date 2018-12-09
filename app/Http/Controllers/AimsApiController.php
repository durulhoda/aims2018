<?php

namespace App\Http\Controllers;

use App\institutesettings\Division;
use Illuminate\Http\Request;

class AimsApiController extends Controller
{
    public function read(){
        header('Access-Control-Allow-Origin: *'); 
        header('Content-Type: application/json');
        $divisionList=Division::all();
        echo json_encode($divisionList);
    }
    public function insert(){
        header('Access-Control-Allow-Origin: *'); 
        header('Content-Type: application/json');
        header('Access-Control-Allow-Methods:post');
        header("Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With");
        $post=json_decode(file_get_contents("php://input"));
        $aDivision=new Division();
        $aDivision->name=$post->name;
        if($aDivision->save()){
           echo json_encode(array('message'=>"Division Create"));
        }else{
             echo json_encode(array('message'=>"Division not Create"));
        }
    }
    public function edit($id){

    }
}
