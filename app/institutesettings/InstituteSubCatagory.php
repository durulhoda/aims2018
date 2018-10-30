<?php

namespace App\institutesettings;

use Illuminate\Database\Eloquent\Model;

class InstituteSubCatagory extends Model
{
    protected $table='institutesubcategory';
   	protected $fillable = ['name','subcategoryid','status'];
}
