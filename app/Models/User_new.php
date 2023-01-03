<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class User_new extends MongoModel
{
    //
    protected $collection = 'users_new';
    protected $fillable = [
        'userId',
        'userName',
        'email',
        'password',
        'rank',
        'rating',
        'points',
        'badges',
        'reports',
        'avatar',
        'products'
    ];

}
