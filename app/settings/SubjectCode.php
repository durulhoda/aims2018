<?php

namespace App\settings;

use Illuminate\Database\Eloquent\Model;

class SubjectCode extends Model
{
	 protected $table='subjectcodes';
     protected $fillable = ['name','courseid','programid','status'];
}
