<?php

namespace App\Http\Controllers;

use App\FileManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Traits\StorageFileStrait;

class FileManagerController extends Controller
{
    use StorageFileStrait;

    private $fileManager;


    public function __construct(FileManager $fileManager)
    {
        $this->fileManager = $fileManager;
    }

    public function index()
    {
        $listFolder = $this->fileManager->where('type','folder')->get();

        $feature_path_show = 'root';

        return view('admin.files.index', compact('listFolder', 'feature_path_show'));
    }

    public function createFolder(Request $request, $id)
    {
        $listFolderForId = $this->fileManager->where('parent_id', $id)->get();

        foreach ($listFolderForId as $FolderForid) {
            if ($FolderForid->type == 'folder' && $FolderForid->name == $request->folder) {
                return response()->json([
                    'code' => 500,
                    'message' => 'fail'
                ], 500);
            }
        }
        try {
            DB::beginTransaction();

            $folderName = $request->folder;
            if ($id != 0) {
                $parent_folder = $this->fileManager->where('id', $id)->first();
                $parent_path = $parent_folder->feature_path;

                $feature_path = $parent_path . '/' . $folderName;
            } else {
                $feature_path = 'root/' . $folderName;
            }
            $path = $this->createDirecrotory($feature_path);

            $folder_de_load_js = $this->fileManager->create([
                'name' => $folderName,
                'type' => 'folder',
                'user_id' => auth()->id(),
                'feature_path' => $path,
                'parent_id' => $id
            ]);

            DB::commit();
            return response()->json([
                'code' => 200,
                'message' => 'success',
                'data_folder' => $folder_de_load_js
            ], 200);

        } catch (\Exception $exception) {
            Log::error('Message' . $exception->getMessage() . ' ------Line ' . $exception->getLine());
            DB::rollBack();
            return response()->json([
                'code' => 500,
                'message' => 'fail'
            ], 500);
        }
    }

    public function selectedFolder($id)
    {
        $listFolderAndFileForId = $this->fileManager->where('parent_id', $id)->latest()->paginate(20); //lay ca folder va file theo parent id
        $listFolder = $this->fileManager->where('type', 'folder')->get();

        $root_parent = $this->fileManager->where('id', $id)->first();

        return view('admin.files.index', compact('listFolder', 'listFolderAndFileForId', 'root_parent'));
    }
}
