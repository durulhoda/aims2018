<?php

namespace App\Http\Controllers\settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\role\RoleHelper;
class SectionOfferController extends Controller
{
    public function __construct()
{
    $this->middleware('auth');
}
}
