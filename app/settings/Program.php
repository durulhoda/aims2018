<?php

namespace App\settings;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
	 protected  $table='programs';
     protected $fillable = ['instituteid','name','status'];
     public function getAllPrograms($id=0){
     	if($id==0){
     		$result=\DB::table('programs')
			->join('institute', 'programs.instituteid', '=', 'institute.id')
			->select('programs.id','institute.name AS instituteName','programs.name')
			->get();
     	}else{
     		$result=\DB::table('programs')
			->join('institute', 'programs.instituteid', '=', 'institute.id')
			->select('programs.id','institute.name AS instituteName','programs.name')
			->where('instituteid',$id)
			->get();
     	}
		return $result;
     }
}
