<?php

namespace App\Http\Controllers;
use App\RoleHelper;
use App\Role;
use Illuminate\Http\Request;

class Role1Controller extends Controller
{
    public function index(){
    	$rh=new RoleHelper();
    	return view('roleconfig.role1.index');
    }
    public function create(){
    	$sidebarMenu=Role::getMenu();
    	
    	return view('roleconfig.role1.create',['sidebarMenu'=>$sidebarMenu]);
    }
    public function store(Request $request){

    }
    public function edit($id){

    }
    public function update(Request $request, $id){
    	
    }
}
