<?php

namespace App\settings;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
     protected $fillable = ['name','startTime','endTime','status'];
}
