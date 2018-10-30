<?php
namespace App\Http\Controllers\settings;
use App\Http\Controllers\Controller;
use App\settings\Session;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function index(){
        $result=Session::all();
        return view('settings.session.index',['result'=>$result]);
    }
    public function create(){
        return view('settings.session.create');
    }
    public function store(Request $request){
        $aObj=new Session();
        $aObj->name=$request->name;
        $aObj->save();
        return redirect('session');
    }
    public function edit($id)
    {
        $aObj=Session::findOrfail($id);
        return view('settings.session.edit',['bean'=>$aObj]);
    }
     public function update(Request $request, $id)
    {
        $aObj=Session::findOrfail($id);
        $aObj->name=$request->name;
        $aObj->update();
        return redirect('session');
    }
}