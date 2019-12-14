<?php
namespace App\Http\Transformers;

use App\Models\File;

class FileTransformer extends AbstractTransformer
{
    public function transform(File $file)
    {
        return [
            'id' => $file->id 
        ];
    }
}
