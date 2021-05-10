<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;
use Storage;


trait StorageFileStrait
{
    public function createDirecrotory($feature_path)
    {
        $feature_path = str_replace('/storage/app/', '', $feature_path);
        $path = storage_path('app/' . $feature_path);

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
            return Storage::url('app/' . $feature_path);
        }
        return null;
    }

    public function storageTraitUploadMultipe($file, $folderName)
    {
        $fileNameOrigin = $file->getClientOriginalName();
        $folderName = str_replace('/storage/app/', '', $folderName);

        $filePath = $file->storeAs($folderName, $fileNameOrigin);

        $dataUploadTrait = [
            'file_name' => $fileNameOrigin,
            'file_path' => Storage::url($filePath),
            'size' => filesize($file)
        ];

        return $dataUploadTrait;
    }
}
