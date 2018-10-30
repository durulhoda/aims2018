<?php

namespace App\institutesettings;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
	protected $table='divisions';
   	protected $fillable = ['name','status'];
}
