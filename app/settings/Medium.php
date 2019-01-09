<?php

namespace App\settings;

use Illuminate\Database\Eloquent\Model;

class Medium extends Model
{
	 protected $table="mediums";
     protected $fillable = ['instituteid','name','status'];
     public function getAllMedium($id=0){
     	if($id==0){
     		$result=\DB::table('mediums')
            ->join('institute', 'mediums.instituteid', '=', 'institute.id')
            ->select('mediums.*','institute.name AS instituteName')
            ->get();
     	}else{
     		$result=\DB::table('mediums')
            ->join('institute', 'mediums.instituteid', '=', 'institute.id')
            ->select('mediums.*','institute.name AS instituteName')
            ->where('instituteid',$id)
            ->get();
     	}
     	return $result;
     }
}
