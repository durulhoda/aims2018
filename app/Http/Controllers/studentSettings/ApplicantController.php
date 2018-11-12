<?php

namespace App\Http\Controllers\studentsettings;

use Illuminate\Http\Request;
use App\Role;
use App\Http\Controllers\Controller;
use App\settings\ProgramLevel;
use App\settings\Program;
class ApplicantController extends Controller
{
	public function __construct()
{
    $this->middleware('auth');
}
	public function index()
	{
		$accessStatus=Role::getAccessStatus();
		$result=\DB::table('programs')->join('program_levels','programs.programLevelid','=','program_levels.id')->select('programs.*', 'program_levels.programLevel')
		->get();
		return view('studentsettings.applicant.index',['result'=>$result,'accessStatus'=>$accessStatus]);
	}
	public function create()
	{
		$accessStatus=Role::getAccessStatus();
		if($accessStatus[2]==1){
			$allLevel=ProgramLevel::all();
			return view('studentsettings.applicant.create',compact('allLevel'));
		}else{
			return redirect('program');
		}
		
	}
	public function store(Request $request)
	{ 
		$aBean=new Program();
		$aBean->programName=$request->programName;
		$aBean->programLevelid=$request->programLevelid;
		$aBean->classId=$request->classId;
		$aBean->save();
		return redirect('program');
	}
	public function edit($id)
	{
		$accessStatus=Role::getAccessStatus();
		if($accessStatus[4]==1){
			$allLevel=ProgramLevel::all();
			$aBean=Program::findOrfail($id);
			return view('settings.program.edit',['bean'=>$aBean,'allLevel'=>$allLevel]);
		}else{
			return redirect('program');
		}

	}
	public function update(Request $request, $id)
	{
		$aBean=Program::findOrfail($id);
		$aBean->programName=$request->programName;
		$aBean->programLevelid=$request->programLevelid;
		$aBean->classId=$request->classId;
		$aBean->update();
		return redirect('program');
	}
}
