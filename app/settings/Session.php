<?php

namespace App\settings;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
     protected $fillable = ['name','instituteid','status'];
     public function getAllSession($id=0){
     	if($id==0){
     		$result=\DB::table('sessions')
	       ->join('institute', 'sessions.instituteid', '=', 'institute.id')
	       ->select('sessions.id','institute.name AS instituteName','sessions.name')
	       ->get();
     	}else{
     		 $result=$sessionList=\DB::table('sessions')
	       ->join('institute', 'sessions.instituteid', '=', 'institute.id')
	       ->select('sessions.id','institute.name AS instituteName','sessions.name')
	       ->where('instituteid',$id)
	       ->get();
	     }
	     return $result;
     }
}
