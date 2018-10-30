<?php

namespace App\settings;

use Illuminate\Database\Eloquent\Model;

class Medium extends Model
{
	 protected $table="mediums";
     protected $fillable = ['name','status'];
}
