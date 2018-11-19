<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
class HomeController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index()
	{
		$accessStatus=Role::getAccessStatus();
		$sidebarMenu=Role::getMenu();
		return view('home',['accessStatus'=>$accessStatus,'sidebarMenu'=>$sidebarMenu]);
	}

}
