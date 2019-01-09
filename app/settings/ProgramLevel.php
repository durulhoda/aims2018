<?php

namespace App\settings;

use Illuminate\Database\Eloquent\Model;

class ProgramLevel extends Model
{
	protected $table="programlevels";
    protected $fillable = ['instituteid','name','status'];
    public function getAllLevel($id=0){
     	if($id==0){
     		 $result=\DB::table('programlevels')
		      ->join('institute', 'programlevels.instituteid', '=', 'institute.id')
		      ->select('programlevels.*','institute.name AS instituteName')
		      ->get();
     	}else{
     		$result=\DB::table('programlevels')
	      ->join('institute', 'programlevels.instituteid', '=', 'institute.id')
	      ->select('programlevels.*','institute.name AS instituteName')
	      ->where('instituteid',$id)
	      ->get();
     	}
     	return $result;
    }
}
