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
	$sidebarMenu=Role::getMenu();
	$accessStatus=Role::getAccessStatus();
    return view('home',['accessStatus'=>$accessStatus,'sidebarMenu'=>$sidebarMenu]);
}

}
