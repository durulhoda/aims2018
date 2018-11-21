<?php

namespace App\Http\Controllers\role;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
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
