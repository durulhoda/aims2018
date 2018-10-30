<?php

namespace App\Http\Controllers\settings;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\settings\Shift;
use App\settings\Section;
class ShiftController extends Controller
{
	public function index(){
		$result=Shift::all();
		foreach ($result as $aObj) {
			$aObj->startTime=date("g:i a", strtotime($aObj->startTime));
			$aObj->endTime=date("g:i a", strtotime($aObj->endTime));
		}
		return view('settings.shift.index',['result'=>$result]);
	}
	public function create(){
		
		return view('settings.shift.create');
	}
	public function store(Request $request){
		$aObj=new Shift();
		$aObj->name=$request->name;
		$aObj->startTime=$request->startTime;
		$aObj->endTime=$request->endTime;
		$aObj->startTime=date("H:i", strtotime($aObj->startTime));
		$aObj->endTime=date("H:i", strtotime($aObj->endTime));
		echo $aObj->endTime;
		$aObj->save();
		return redirect('shift');
	}
	public function edit($id)
	{
		$aObj=Shift::findOrfail($id);
		$aObj->startTime=date("g:i a", strtotime($aObj->startTime));
		$aObj->endTime=date("g:i a", strtotime($aObj->endTime));
		return view('settings.shift.edit',['bean'=>$aObj]);
	}
	 public function update(Request $request, $id)
    {
    	$aObj=Shift::findOrfail($id);
    	$aObj->name=$request->name;
		$aObj->startTime=$request->startTime;
		$aObj->endTime=$request->endTime;
		$aObj->startTime=date("H:i", strtotime($aObj->startTime));
		$aObj->endTime=date("H:i", strtotime($aObj->endTime));
		$aObj->update();
		return redirect('shift');
    }
}
