<?php
namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as MongoModel;

class File extends MongoModel
{
    protected $fillable = [
        'path'
    ];

}
