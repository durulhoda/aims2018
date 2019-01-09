<?php

namespace App\institutesettings;

use Illuminate\Database\Eloquent\Model;

class VProgramLevel extends Model
{
	protected $table="vprogramlevels";
	protected $fillable = ['programlevelid','programid','status'];
	public function getAllProgramLevel($id=0){
		if($id==0){
			$result=\DB::table('vprogramlevels')
	        ->join('programs', 'vprogramlevels.programid', '=', 'programs.id')
	        ->join('programlevels', 'vprogramlevels.programlevelid', '=', 'programlevels.id')
	        ->join('institute', 'programs.instituteid', '=', 'institute.id')
	        ->select('vprogramlevels.id','institute.name AS instituteName','programs.name AS programName','programlevels.name AS levelName')
	        ->orderByRaw('id')
	        ->get();
		}else{
			$result=\DB::table('vprogramlevels')
	        ->join('programs', 'vprogramlevels.programid', '=', 'programs.id')
	        ->join('programlevels', 'vprogramlevels.programlevelid', '=', 'programlevels.id')
	        ->join('institute', 'programs.instituteid', '=', 'institute.id')
	        ->select('vprogramlevels.id','institute.name AS instituteName','programs.name AS programName','programlevels.name AS levelName')
	        ->orderByRaw('id')
	        ->where('programs.instituteid',$id)
	        ->get();
		}
		return $result;
	}	
}