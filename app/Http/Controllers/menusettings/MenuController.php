<?php

namespace App\Http\Controllers\menusettings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\menusettings\Menu;
class MenuController extends Controller
{
    public function index(){
        $result=\DB::select('SELECT vmenus.id as childid,vmenus.name as child,menus.name as parent,vmenus.url from menus INNER JOIN (SELECT * FROM `menus`) as vmenus ON vmenus.parentid=menus.id union ALL SELECT menus.id as childid,menus.name AS child,menus.name AS parent,menus.url FROM `menus` WHERE parentid=0 order by childid');
        return view('menusettings.menu.index',['result'=>$result]);
    }
    public function create(){
        $parents=Menu::all();
        return view('menusettings.menu.create',['parents'=>$parents]);
    }
    public function store(Request $request){
        $aBean=new Menu();
        $aBean->name=$request->name;
        $aBean->parentid=$request->parentid;
        $aBean->url=$request->url;
        $aBean->save();
        return redirect('menu');
    }
    public function edit($id){
        $aBean=Menu::findOrfail($id);
        $parents=\DB::table('menus')
        ->where('id','!=', $id)
        ->get();
        return view('menusettings.menu.edit',['bean'=>$aBean,'parents'=>$parents]);
    }
    public function update(Request $request, $id){
    	$aBean=Menu::findOrfail($id);
        $aBean->name=$request->name;
        $aBean->parentid=$request->parentid;
        $aBean->update();
        return redirect('menu');
    }
}