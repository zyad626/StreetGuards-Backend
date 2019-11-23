<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as MongoModel;

class Incident extends MongoModel
{
    //
    protected $fillable = [
        'date',
        'location',
        'type',
        'road_type',
        'road_surface_condition',
        'weather',
        'description',
        'files'
    ];
}
