<?php

namespace App\settings;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
	 protected $table="shifts";
     protected $fillable = ['instituteid','name','startTime','endTime','status'];
     public function getAllShifts($id=0){
     	if($id==0){
     		$result=\DB::table('shifts')
            ->join('institute', 'shifts.instituteid', '=', 'institute.id')
            ->select('shifts.*','institute.name AS instituteName')
            ->get();
     	}else{
     		$result=\DB::table('shifts')
            ->join('institute', 'shifts.instituteid', '=', 'institute.id')
            ->select('shifts.*','institute.name AS instituteName')
            ->where('instituteid',$id)
            ->get();
     	}
     	return $result;
     }
}
