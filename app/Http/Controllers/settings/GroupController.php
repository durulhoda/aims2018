<?php

namespace App\Http\Controllers\settings;
use App\Http\Controllers\Controller;
use App\settings\ProgramLevel;
use Illuminate\Http\Request;
use App\settings\Group;
class GroupController extends Controller
{
	public function index(){
		$result=\DB::table('groups')
		->join('programlevels','groups.programLevelid','=','programlevels.id')->select('groups.*','programlevels.name as levelName')->get();
		return view('settings.group.index',['result'=>$result]);
	}
	public function create(){
		$levels=ProgramLevel::all();
		return view('settings.group.create',compact('levels'));
	}
	public function store(Request $request){
		$aObj=new Group();
		$aObj->name=$request->name;
		$aObj->programLevelid=$request->programLevelid;
		$aObj->save();
		return redirect('group');
	}
	public function edit($id)
	{	
		$levels=ProgramLevel::all();
		$aObj=Group::findOrfail($id);
		return view('settings.group.edit',['bean'=>$aObj,'levels'=>$levels]);
	}
	 public function update(Request $request, $id)
    {
    	$aObj=Group::findOrfail($id);
    	$aObj->name=$request->name;
    	$aObj->programLevelid=$request->programLevelid;
		$aObj->update();
		return redirect('group');
    }
}
