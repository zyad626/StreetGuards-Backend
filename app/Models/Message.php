<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Message extends MongoModel
{
    use SoftDeletes;
    //
    protected $fillable = [
        'name',
        'email',
        'organization',
        'message'
    ];

}
