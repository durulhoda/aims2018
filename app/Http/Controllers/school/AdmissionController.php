<?php

namespace App\Http\Controllers\school;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\settings\Session;
use App\settings\Program;
use App\settings\Group;
use App\settings\Medium;
use App\settings\Shift;
use App\school\Applicant;
class AdmissionController extends Controller
{
    public function index(){
    	$instituteId=1;
    	$sessionList=\DB::select("select t1.instituteid,sessions.* from (SELECT 
admissionprogram.instituteid,admissionprogram.sessionid 
FROM admissionprogram WHERE admissionprogram.instituteid=? GROUP BY admissionprogram.sessionid) AS t1
INNER JOIN sessions ON t1.sessionid=sessions.id",[$instituteId]);
    	$programList=\DB::select("select t1.instituteid,programs.* from (SELECT 
admissionprogram.instituteid,admissionprogram.programid 
FROM admissionprogram WHERE admissionprogram.instituteid=? GROUP BY admissionprogram.programid) AS t1
INNER JOIN programs ON t1.programid=programs.id",[$instituteId]);
    	$groupList=\DB::select("select t1.instituteid,groups.* from (SELECT 
admissionprogram.instituteid,admissionprogram.groupid 
FROM admissionprogram WHERE admissionprogram.instituteid=? GROUP BY admissionprogram.groupid) AS t1
INNER JOIN groups ON t1.groupid=groups.id",[$instituteId]);
    	$mediumList=\DB::select("select mediums.* from (SELECT 
instituteid,mediumid 
FROM admissionprogram WHERE instituteid=? GROUP BY mediumid) AS t1
INNER JOIN mediums ON t1.mediumid=mediums.id",[$instituteId]);
		$shiftList=\DB::select("select shifts.* from (SELECT 
instituteid,shiftid 
FROM admissionprogram WHERE instituteid=2 GROUP BY shiftid) AS t1
INNER JOIN shifts ON t1.shiftid=shifts.id",[$instituteId]);
    	return view('school.admission',['instituteId'=>$instituteId,'sessionList'=>$sessionList,'programList'=>$programList,'groupList'=>$groupList,'mediumList'=>$mediumList,'shiftList'=>$shiftList]);
    }
    public function store(Request $request){
        $aApplicant=new Applicant();
    	$aApplicant->name=$request->name;
        $pictureurl_temp = $request->pictureurl;
        // dd($pictureurl_temp);
        $signatureurl_temp = $request->signatureurl;
        if($pictureurl_temp){
            $flag_url=$pictureurl_temp->getClientOriginalName();
            $explode_file_name=explode('.',$flag_url);
            $extention=end($explode_file_name);
            $unique_name=substr(md5(time()),0,12);
            $generated_file_name=$unique_name.'.'.$extention;
            $upload_file->move('admin/images/student',$generated_file_name);
            $aApplicant->pictureurl=$generated_file_name;
            $aApplicant->save();
            dd("stop");
        }
    }
}
