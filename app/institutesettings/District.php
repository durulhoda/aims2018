<?php

namespace App\institutesettings;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
   	protected $table='districts';
   	protected $fillable = ['name','divisionid','status'];
}
