<?php

namespace App\Http\Controllers\institutesettings;
use App\institutesettings\Branch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BranchController extends Controller
{
    public function index(){
     	$result=\DB::table('branches')
        ->join('institute','branches.instituteid','=','institute.id')
        ->select('branches.*','institute.name as instituteName')->get();
        return view('institutesettings.branch.index',['result'=>$result]);
    }
    public function create(){
    	$institutes=\DB::table('institute')->get();
    	return view('institutesettings.branch.create',['institutes'=>$institutes]);
    }
    public function store(Request $request){
    	$aBean=new Branch();
        $aBean->name=$request->name;
        $aBean->code=$request->code;
        $aBean->instituteid=$request->instituteid;
        $aBean->save();
        return redirect('branch');
    }
    public function edit($id){
    	$aBean=Branch::findOrfail($id);
        $institutes=\DB::table('institute')->get();
        return view('institutesettings.branch.edit',['bean'=>$aBean,'institutes'=>$institutes]);
    }
    public function update(Request $request, $id){
    	$aBean=Branch::findOrfail($id);
        $aBean->name=$request->name;
        $aBean->code=$request->code;
        $aBean->instituteid=$request->instituteid;
        $aBean->update();
        return redirect('branch');
    }
}
