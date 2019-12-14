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
        'files',

        //Accident
        'type_of_collision',
        'number_of_vehicles',
        'number_of_bikes',
        'number_of_pedesterians',
        'number_of_injuries',
        'number_of_fatalities',
        'purpose_of_trip',
        'reporter_involved',

        //Hazard
        'hazard_type',
        'collision_type',
        'type_of_collider',

        //Threatening incident
        'threatening_type',
        
        //General
        'road_type',
        'road_surface_condition',
        'weather',
        'description',
    ];
}
