<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class User_new extends MongoModel
{
	use Authenticatable;
	use HasApiTokens, Notifiable;
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
