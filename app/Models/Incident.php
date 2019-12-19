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
        'description',
        'crash_data',
        'hazard_data',
        'incident_data',
    ];

    public function files()
    {
        return $this->hasMany('App\Models\File');
    }
}
