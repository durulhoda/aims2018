<?php

namespace App\settings;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
	 protected $table="shifts";
     protected $fillable = ['instituteid','name','startTime','endTime','status'];
}
