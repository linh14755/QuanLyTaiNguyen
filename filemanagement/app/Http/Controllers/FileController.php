<?php

namespace App\Http\Controllers;

use App\FileManager;
use App\Traits\StorageFileStrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FileController extends Controller
{
    use StorageFileStrait;

    public function __construct(FileManager $fileManager)
    {
        $this->fileManager = $fileManager;
    }

    public function createFile()
    {
        $listFolder = $this->fileManager->get(); //lay ca folder va file
        return view('admin.uploadfile.index', compact('listFolder'));
    }

    public function selectedFile($id)
    {
        $listFolder = $this->fileManager->get();

        $root_parent = $this->fileManager->where('id', $id)->first();

        return view('admin.uploadfile.index', compact('listFolder', 'root_parent'));
    }

    public function uploadFile(Request $request, $id)
    {
        if ($id != 0) {
            $parent_folder = $this->fileManager->where('id', $id)->first();
            $parent_path = $parent_folder->feature_path;

            $feature_path = $parent_path;
        } else {
            $feature_path = 'root';
        }

        try {
            DB::beginTransaction();

            if ($request->hasFile('files_upload')) {
                foreach ($request->files_upload as $file) {
                    $dataUploadTrait = $this->storageTraitUploadMultipe($file, $feature_path);

                    $extenstion = explode('.', $dataUploadTrait['file_name']);

                    //Kiem tra xem ten file co bi trung trong database hay khong roi moi add
                    $listFileAndFolder = $this->fileManager->where('parent_id', $id)->get();
                    foreach ($listFileAndFolder as $FileAndFolder) {
                        if ($FileAndFolder->name == $dataUploadTrait['file_name']) {
                            DB::commit();
                            return redirect()->route('file.selected', ['id' => $id]);
                        }
                    }

                    $this->fileManager->create([
                        'name' => $dataUploadTrait['file_name'],
                        'type' => 'file',
                        'extenstion' => $extenstion[1],
                        'user_id' => auth()->id(),
                        'feature_path' => str_replace('//', '/', $dataUploadTrait['file_path']),
                        'parent_id' => $id,
                        'size' => $dataUploadTrait['size']
                    ]);

                }
            }

            DB::commit();
            return redirect()->route('file.selected', ['id' => $id]);

        } catch (\Exception $exception) {
            Log::error('Message' . $exception->getMessage() . ' ------Line ' . $exception->getLine());
            DB::rollBack();
            return response()->json([
                'code' => 500,
                'message' => 'fail'
            ], 500);
        }
    }
}
