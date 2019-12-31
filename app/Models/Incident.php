<?php

namespace App\Models;



class Incident extends MongoModel
{
    //
    protected $fillable = [
        'date',
        'location',
        'type',
        'description',
        'crash_data',
        'hazard_data',
        'incident_data',
    ];

    public function files()
    {
        return $this->belongsToMany('App\Models\File');
    }
}
