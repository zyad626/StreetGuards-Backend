<?php
namespace App\Models;



class File extends MongoModel
{
    protected $fillable = [
        'path'
    ];

    public function isImage()
    {
        return $this->type == 'image' ? true : false;
    }

    public function getNameAttribute()
    {
        return $this->_id.'.'.$this->extension;
    }
}
