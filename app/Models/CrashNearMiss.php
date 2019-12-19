<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as MongoModel;

class CrashNearMiss extends MongoModel
{
    //
    protected $fillable = [
        'is_crash',

        'number_involved_bikes',
        'number_involved_vehicles',
        'number_involved_pedestrians',

        'resulted_congestion',
        'type_of_collision',
        
        'number_of_injuries',
        'number_of_fatalities',
        
        'reporter_involved',
        'reporter_type',
    ];
}
