<?php

namespace App\settings;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
	 protected  $table='programs';
     protected $fillable = ['name','groupid','status'];
}
