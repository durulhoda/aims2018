<?php

namespace App\institutesettings;

use Illuminate\Database\Eloquent\Model;

class VProgramGroup extends Model
{
    protected $table="vprogramgroup";
	protected $fillable = ['programid','groupid','status'];
	public function getAllProgramGroup($id=0){
		if($id==0){
			$result=\DB::table('vprogramgroup')
			->join('programs', 'vprogramgroup.programid', '=', 'programs.id')
			->join('institute', 'programs.instituteid', '=', 'institute.id')
			->join('groups', 'vprogramgroup.groupid', '=', 'groups.id')
			->select('vprogramgroup.id','institute.name AS instituteName','programs.name AS programName','groups.name AS groupName')
			->orderByRaw('id')
			->get();
		}else{
			$result=\DB::table('vprogramgroup')
			->join('programs', 'vprogramgroup.programid', '=', 'programs.id')
			->join('groups', 'vprogramgroup.groupid', '=', 'groups.id')
			->join('institute', 'programs.instituteid', '=', 'institute.id')
			->select('vprogramgroup.id','institute.name AS instituteName','programs.name AS programName','groups.name AS groupName')
			->orderByRaw('id')
			->where('programs.instituteid',$id)
			->get();
		}
		return $result;
	}
}
