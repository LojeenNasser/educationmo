<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

trait HasCover
{
    /**
     * Upload cover image.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $path
     * @param  string  $name
     * @return \Illuminate\Http\UploadedFile
     */
    public function uploadCover($request, $path, $name)
    {
        if ($request->hasFile($name) && $request->file($name)->isValid()) {
            $file = $request->file($name);
            $uploadedFile = $this->moveFileToStorage($file, $path);
            return $uploadedFile;
        }

        return null;
    }

    /**
     * Move the uploaded file to storage.
     *
     * @param  \Illuminate\Http\UploadedFile  $file
     * @param  string  $path
     * @return \Illuminate\Http\UploadedFile
     */
    protected function moveFileToStorage(UploadedFile $file, $path)
    {
        $name = $file->hashName();
        $file->storeAs($path, $name, 'public');
        return $file;
    }
}
