<?php

namespace App\settings;

use Illuminate\Database\Eloquent\Model;

class CourseOffer extends Model
{
    protected $table='courseoffer';
    protected $fillable=['programofferid','subjectcodeid','marks'];
}
