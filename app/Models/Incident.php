<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Incident extends MongoModel
{
    use SoftDeletes;
    //
    protected $fillable = [
        'date',
        'location',
        'type',
        'description',
        'contact',
        'crash_data',
        'hazard_data',
        'threatening_data',
    ];

    public function files()
    {
        return $this->belongsToMany('App\Models\File');
    }
}
