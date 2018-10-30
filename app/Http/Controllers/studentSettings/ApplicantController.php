<?php

namespace App\Http\Controllers\studentSettings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\settings\ProgramLevel;
use App\settings\Program;
class ApplicantController extends Controller
{
    public function index()
	{
		// SELECT programs.*,program_levels.programLevel from programs join program_levels ON programs.programLevelid=program_levels.id
		$result=\DB::table('programs')->join('program_levels','programs.programLevelid','=','program_levels.id')->select('programs.*', 'program_levels.programLevel')
		->get();
		return view('studentsettings.applicant.index',['result'=>$result]);
	}
	public function create()
	{
		$allLevel=ProgramLevel::all();
		return view('studentsettings.applicant.create',compact('allLevel'));
	}
	public function store(Request $request)
	{ 
		$aObj=new Program();
		$aObj->programName=$request->programName;
		$aObj->programLevelid=$request->programLevelid;
		$aObj->classId=$request->classId;
		$aObj->save();
		return redirect('program');
	}
	public function edit($id)
    {
    	 $allLevel=ProgramLevel::all();
    	 $aObj=Program::findOrfail($id);
         return view('settings.program.edit',['bean'=>$aObj,'allLevel'=>$allLevel]);
    }
    public function update(Request $request, $id)
    {
    	$aObj=Program::findOrfail($id);
    	$aObj->programName=$request->programName;
		$aObj->programLevelid=$request->programLevelid;
		$aObj->classId=$request->classId;
		$aObj->update();
		return redirect('program');
    }
}
