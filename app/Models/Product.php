<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Product extends MongoModel
{
    protected $collection = "Products";
    protected $fillable = [
        'id',
        'title',
        'description',
        'price',
        'image',
        'seller',
        'email'
    ];
}