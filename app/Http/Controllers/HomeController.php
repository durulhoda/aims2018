<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\role\RoleHelper;
class HomeController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index()
	{
		$rh=new RoleHelper();
        $sidebarMenu=$rh->getMenu();
		return view('home',['sidebarMenu'=>$sidebarMenu]);
	}
}
