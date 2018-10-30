<?php

namespace App\settings;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['name','status'];
}
