<?php

namespace App\employee;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table='employees';
   	protected $fillable = ['name','employeeid','employeetypeid','status'];
}
