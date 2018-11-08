<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\UserRole;

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
	$user = Auth::user()->id;

	$role = UserRole::where('user_id',$user)->select('role_id')->first();
	
	// dd($role->role_id);

    return view('home');
}
}
