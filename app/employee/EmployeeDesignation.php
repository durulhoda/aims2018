<?php

namespace App\employee;

use Illuminate\Database\Eloquent\Model;

class EmployeeDesignation extends Model
{
    protected $table = 'emp_designation';
    protected $fillable = ['name'];
}
