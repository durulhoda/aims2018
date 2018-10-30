<?php

namespace App\Http\Controllers\settings;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\settings\Section;

class SectionController extends Controller
{
	public function index(){
		$result=Section::all();
		return view('settings.section.index',['result'=>$result]);
	}
	public function create(){
		return view('settings.section.create');
	}
	public function store(Request $request){
		$aObj=new Section();
		$aObj->name=$request->name;
		$aObj->save();
		return redirect('section');
	}
	public function edit($id)
	{
		$aObj=Section::findOrfail($id);
		return view('settings.section.edit',['bean'=>$aObj]);
	}
	 public function update(Request $request, $id)
    {
    	$aObj=Section::findOrfail($id);
    	$aObj->sectionName=$request->sectionName;
		$aObj->update();
		return redirect('section');
    }
}
