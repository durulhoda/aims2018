<?php

namespace App\Http\Controllers\settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SectionOfferController extends Controller
{
    public function __construct()
{
    $this->middleware('auth');
}
}
