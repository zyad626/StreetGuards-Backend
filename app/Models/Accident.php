<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as MongoModel;

class Accident extends MongoModel
{
    //
    protected $fillable = [
        'date',
        'number_of_veicles',
        'number_of_bikes',
        'number_of_pedesterians',
        'purpose_of_trip',
        'type_of_collision',
        'number_of_injuries',
        'number_of_fatalities',
        'purpose_of_trip',
        'reporter'
    ];
}
