<?php

namespace App\employee;

use Illuminate\Database\Eloquent\Model;

class EmployeeType extends Model
{
	protected $table = 'employeetypes';
    protected $fillable = ['name'];
}
