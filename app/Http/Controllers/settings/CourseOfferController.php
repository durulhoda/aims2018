<?php

namespace App\Http\Controllers\settings;
use App\settings\Session;
use App\settings\ProgramLevel;
use App\settings\Program;
use App\settings\Medium;
use App\settings\Shift;
use App\settings\Group;
use App\settings\Course;
use App\settings\ProgramOffer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\settings\CourseOffer;
class CourseOfferController extends Controller
{
   public function index(){
    $sql="SELECT sessions.name As sessionName,programs.name as programName,courseoffer.*,subjectcodes.name AS subjectCode,courses.name AS courseName FROM `courseoffer`
    INNER JOIN  programoffer on courseoffer.programofferid=programoffer.id
    INNER JOIN programs on programoffer.programid=programs.id
    INNER JOIN sessions on programoffer.sessionid=sessions.id
    INNER JOIN subjectcodes on courseoffer.subjectcodeid=subjectcodes.id
    INNER JOIN courses on subjectcodes.courseid=courses.id";
    $result=\DB::select($sql);
    return view('settings.courseoffer.index',['result'=>$result]);
}
public function create(){
     $sessions=Session::all();
    $levels=ProgramLevel::all();
    $mediums=Medium::all();
    $shifts=Shift::all();
    $msg="";
    return view('settings.courseoffer.create',['sessions'=>$sessions,'levels'=>$levels,'mediums'=>$mediums,'shifts'=>$shifts]);
}
public function programofferresult(Request $request){
    $sql="SELECT programoffer.*,sessions.name as sessionName,programlevels.name as levelName,groups.name as groupName,programs.name as programName,mediums.name as mediumName,shifts.name as shiftName
    FROM `programoffer` 
    INNER JOIN sessions on programoffer.sessionid=sessions.id
    INNER JOIN programs on programoffer.programid=programs.id
    INNER JOIN groups on programs.groupid=groups.id
    INNER JOIN programlevels on groups.programLevelid=programlevels.id
    INNER JOIN mediums on programoffer.mediumid=mediums.id
    INNER JOIN shifts on programoffer.shiftid=shifts.id
    where sessionid=? and programid=? and mediumid=? and shiftid=?";
    $result=\DB::select($sql,[$request->sessionid,$request->programid,$request->mediumid,$request->shiftid]);
   if($result){
        $sql="SELECT courseoffer.* from `courseoffer` WHERE courseoffer.programofferid=?";
    $hasProgramOffer=\DB::select($sql,[$result[0]->id]);
    
    $sql="SELECT subjectcodes.*,courses.name AS courseName,vcourseoffer.subjectcodeid As isNull,vcourseoffer.marks
        FROM `subjectcodes`
        INNER JOIN courses ON subjectcodes.courseid=courses.id
        LEFT JOIN (SELECT courseoffer.* FROM `courseoffer`
        WHERE courseoffer.programofferid=?) AS vcourseoffer ON subjectcodes.id=vcourseoffer.subjectcodeid";
    if($hasProgramOffer){
         if($result){
         $aBean=$result[0];
         $courses=\DB::select($sql,[$aBean->id]);
         return view('settings.courseoffer.subjectlist',['bean'=>$aBean,'courses'=>$courses]);
        }else{
            return redirect('getprogramoffer');
        }
    }else{
        $sql="SELECT subjectcodes.*,courses.name AS courseName
        FROM `subjectcodes`
        INNER JOIN courses ON subjectcodes.courseid=courses.id
        WHERE subjectcodes.programid=?";
        $aBean=$result[0];
        $courses=\DB::select($sql,[$aBean->programid]);
        return view('settings.courseoffer.subjectlist1',['bean'=>$aBean,'courses'=>$courses]);
    }
   }else{
        return redirect('courseoffer/create');
   }
    

   
}
public function store(Request $request){
    if(isset($request->check)){
        $check=$request->check;
        foreach ($check as $key) {
        $mark=$_POST['marks_'.$key];
        $subjectcodeid=$_POST['subjectcodeid_'.$key];
        $aBean=new CourseOffer();
        $aBean->programofferid=$request->programofferid;
        $aBean->subjectcodeid=$subjectcodeid;
        $aBean->marks=$mark;
        $aBean->save();
      } 
    }
    return redirect('courseoffer');
}
public function edit($id)
{
   $sql="select vtsubjectcodes.* from(select vtprograms.*,subjectcodes.id AS codeid,subjectcodes.name As codeName,courses.name As courseName 
   from(SELECT programoffer.programid,programs.name As programName from courseoffer
   INNER JOIN programoffer on courseoffer.programofferid=programoffer.id
   INNER JOIN programs ON programoffer.programid=programs.id                       
   WHERE courseoffer.id=?) AS vtprograms
   INNER JOIN subjectcodes ON vtprograms.programid=subjectcodes.programid
   INNER JOIN courses ON subjectcodes.courseid=courses.id) As vtsubjectcodes
   left JOIN courseoffer on  vtsubjectcodes.codeid=courseoffer.subjectcodeid
   WHERE courseoffer.id is null or courseoffer.id=?";
   $result=\DB::select($sql,[$id,$id]);
   $course=\DB::select('SELECT courseoffer.*,courses.name as courseName FROM `courseoffer`
    INNER JOIN subjectcodes on courseoffer.subjectcodeid=subjectcodes.id
    INNER JOIN courses on subjectcodes.courseid=courses.id
    where courseoffer.id=?',[$id]);
   $aBean=CourseOffer::findOrfail($id);
   return view('settings.courseoffer.edit',['bean'=>$aBean,'result'=>$result,'course'=>$course]);
}
public function update(Request $request, $id)
{
     $aBean=CourseOffer::findOrfail($id);
     $aBean->subjectcodeid=$request->subjectcodeid;
     $aBean->marks=$request->marks;
     $sql="select * from courseoffer where id=? and subjectcodeid=?";
    $isSamefield=\DB::select($sql,[$id,$aBean->subjectcodeid]);
    if($isSamefield){
        $aBean->update();
        return redirect('courseoffer');
    }else{
         $aBean->update();
         return redirect('courseoffer');
    }
}
}
