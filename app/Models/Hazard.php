<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as MongoModel;

class Hazard extends MongoModel
{
    //
    protected $fillable = [
        'date',
        'collision_type',
        'type_of_collider',
    ];
}
