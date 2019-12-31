<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use App\Models\File;
use Illuminate\Http\Response;

use Storage;

class FilesController extends Controller
{
    public function view($id)
    {
        $file = File::find($id);
        $fileContent = Storage::get($file->path);
        return response($fileContent)
            ->header('Content-Type', $file->mime_type);
    }
}