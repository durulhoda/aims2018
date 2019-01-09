<?php

namespace App\settings;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
	protected $table="groups";
    protected $fillable = ['instituteid','name','status'];
    public function getAllGroup($id=0){
    	if($id==0){
    		$result=\DB::table('groups')
			->join('institute', 'groups.instituteid', '=', 'institute.id')
			->select('groups.*','institute.name AS instituteName')
			->get();
			// dd($result);
    	}else{
    		$result=\DB::table('groups')
			->join('institute', 'groups.instituteid', '=', 'institute.id')
			->select('groups.*','institute.name AS instituteName')
			->where('instituteid',$id)
			->get();
    	}
    	return $result;
    }
}
