<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
class HomeController extends Controller
{
/**
 * Create a new controller instance.
 *
 * @return void
 */
public function __construct()
{
    $this->middleware('auth');
}

/**
 * Show the application dashboard.
 *
 * @return \Illuminate\Http\Response
 */
public function index()
{

	$dmenu=Role::getMenu();
	$accessStatus=Role::getAccessStatus();
    return view('home',['accessStatus'=>$accessStatus,'dmenu'=>$dmenu]);
}

}
