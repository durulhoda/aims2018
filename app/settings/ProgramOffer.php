<?php

namespace App\settings;

use Illuminate\Database\Eloquent\Model;

class ProgramOffer extends Model
{
	protected $table='programoffer';
     protected $fillable = ['sessionid','programid','mediumid','shiftid','applicantSeat','quota','status'];
}
