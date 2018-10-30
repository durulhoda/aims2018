<?php

namespace App\institutesettings;

use Illuminate\Database\Eloquent\Model;

class InstituteCatagory extends Model
{
    protected $table='institutecategory';
   	protected $fillable = ['name','status'];
}
