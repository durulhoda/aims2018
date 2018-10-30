<?php

namespace App\Http\Controllers\institutesettings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InstituteController extends Controller
{
	 public function index()
    {
        return view('institutesettings.institute.index');
    }
    public function create(){
    	return view('institutesettings.institute.create');
    }
}
