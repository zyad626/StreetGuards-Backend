<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as MongoModel;

class Accident extends MongoModel
{
    //
    protected $fillable = [
        'date',
        'number_of_vehicles',
        'number_of_bikes',
        'number_of_pedesterians',
        'type_of_collision',
        'number_of_injuries',
        'number_of_fatalities',
        'purpose_of_trip',
        'reporter_involved'
    ];
}
