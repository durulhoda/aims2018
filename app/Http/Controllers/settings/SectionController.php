<?php

namespace App\Http\Controllers\settings;
use App\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\settings\Section;

class SectionController extends Controller
{
	public function __construct()
{
    $this->middleware('auth');
}
	public function index(){
		$accessStatus=Role::getAccessStatus();
		$result=Section::all();
		return view('settings.section.index',['result'=>$result]);
	}
	public function create(){
		$accessStatus=Role::getAccessStatus();
		if($accessStatus[2]==1){
			return view('settings.section.create');
		}else{
			return redirect('section');
		}
	}
	public function store(Request $request){
		$aObj=new Section();
		$aObj->name=$request->name;
		$aObj->save();
		return redirect('section');
	}
	public function edit($id)
	{
		$accessStatus=Role::getAccessStatus();
		if($accessStatus[4]==1){
			$aObj=Section::findOrfail($id);
			return view('settings.section.edit',['bean'=>$aObj]);
		}else{
			return redirect('section');
		}
		
	}
	 public function update(Request $request, $id)
    {
    	$aObj=Section::findOrfail($id);
    	$aObj->sectionName=$request->sectionName;
		$aObj->update();
		return redirect('section');
    }
}
