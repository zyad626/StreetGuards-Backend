<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as MongoModel;

class ThreateningIncident extends MongoModel
{
    //
    protected $fillable = [
        'threatening_type'
    ];
}
