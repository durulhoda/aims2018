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
    	$sessionList=\DB::select("select sessions.* from 
(SELECT * FROM programoffer WHERE instituteid=? GROUP BY sessionid) AS t1
INNER JOIN sessions ON t1.sessionid=sessions.id",[$instituteId]);
        $programList=array();
    	$groupList=array();
        $mediumList=array();
        $shiftList=array();
    	return view('school.admission',['instituteId'=>$instituteId,'sessionList'=>$sessionList,'programList'=>$programList,'groupList'=>$groupList,'mediumList'=>$mediumList,'shiftList'=>$shiftList]);
    }
    public function store(Request $request){
        $aApplicant=new Applicant();
    	$aApplicant->name=$request->name;
        $upload_file_pictureurl = $request->pictureurl;
        $upload_file_signatureurl= $request->signatureurl;
        if($upload_file_pictureurl){
            $flag_url=$upload_file_pictureurl->getClientOriginalName();
            $explode_file_name=explode('.',$flag_url);
            $extention=end($explode_file_name);
            $unique_name="2019000001";
            $generated_file_name=$unique_name.'.'.$extention;
            $upload_file_pictureurl->move('admin/images/student',$generated_file_name);
            dd("Ok");
            // $aApplicant->pictureurl=$generated_file_name;
            // $aApplicant->save();
        }
    }
}
