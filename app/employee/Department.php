<?php

namespace App\employee;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
   protected $table = 'department';
    protected $fillable = ['name'];
}
