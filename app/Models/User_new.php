<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class User_new extends MongoModel
{
    //
    protected $collection = 'users_new';
    protected $fillable = [
        'userId',
        'name',
        'email',
        'password',
        'gender',
        'isExpert',
        'isTransportationExpert',
        'date',
        'birthDate',
        'profession',
        'carOwnership',
        'drivingExperience',
        'avatar',
        'badges',
        'rank',
        'rating',
        'points',
        'products',
        'favProductsList'
    ];

}
