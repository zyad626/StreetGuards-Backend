<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class User extends MongoModel
{
    use SoftDeletes;
    protected $fillable = [
        'userId','isExpert','isTransportationExpert',
        'birthDate','carOwnership',
        'drivingExperience','gender','profession',
        'name', 'email'
    ];
}
