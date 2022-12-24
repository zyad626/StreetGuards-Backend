<?php
namespace App\Http\Controllers\API;

use App\Http\Transformers\FileTransformer;
use App\Models\File;
use Illuminate\Http\Request;
use Storage;

class FilesController extends Controller
{
    public function create(Request $request)
    {
        $this->validate($request, [
            'file' => 'file|max:200000'
        ]);
        $path = $request->file->store('files');
        $fileExtension = $request->file->getClientOriginalExtension();
        $fileType = $request->file->getMimeType();
        $file = new File();
        $file->path = $path;
        $file->mime_type = $fileType;
        $parts = explode('/', $fileType);
        $file->type = $parts[0];
        $file->extension = $fileExtension;
        $file->thumbs = $this->createThumbs($path);
        $file->save();
        return $this->itemResponse($file, new FileTransformer);
    }

    public function upload(Request $request)
    {
        $this->validate($request, [
            'file' => 'file|max:200000'
        ]);
        $path = $request->file->store('files');
        $fileExtension = $request->file->getClientOriginalExtension();
        $fileType = $request->file->getMimeType();
        $file = new File();
        $file->path = $path;
        $file->mime_type = $fileType;
        $parts = explode('/', $fileType);
        $file->type = $parts[0];
        $file->extension = $fileExtension;
        $file->thumbs = $this->createThumbs($path);
        $file->save();
        return response()->json(['path' => asset("storage/".$path )]);
    }


    protected function createThumbs()
    {
        return [];
    }
}
