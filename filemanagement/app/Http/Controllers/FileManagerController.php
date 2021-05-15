<?php

namespace App\Http\Controllers;

use App\FileManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Traits\StorageFileStrait;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

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
        $listFolder = $this->fileManager->where('type', 'folder')->get();

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

            $feature_path = str_replace('/storage/', '', $feature_path);

            $this->createDirecrotory($feature_path);

            $folder_de_load_js = $this->fileManager->create([
                'name' => $folderName,
                'type' => 'folder',
                'user_id' => auth()->id(),
                'feature_path' => '/storage/' . $feature_path,
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
        $listFolderAndFileForId = $this->fileManager->where('parent_id', $id)->latest()->get(); //lay ca folder va file theo parent id
        $listFolder = $this->fileManager->where('type', 'folder')->get();

        $root_parent = $this->fileManager->find($id);


        return view('admin.files.index', compact('listFolder', 'listFolderAndFileForId', 'root_parent'));
    }

    public function editFileOrFolder($id)
    {
        $file_or_folder_edit = $this->fileManager->find($id);

        if ($file_or_folder_edit->type == 'file') {

            //Edit files
            $listFolder = $this->fileManager->where('type', 'folder')->get();
            $file_edit = $file_or_folder_edit;
            return view('admin.files.file_edit.edit', compact('listFolder', 'file_edit'));
        }
    }

    public function updateFile(Request $request, $id)
    {
        $oldfile = $this->fileManager->find($id);
        $oldfile = str_replace('/storage/', '', $oldfile->feature_path);

        if ($request->parent_id != 0) {
            $newpath = $this->fileManager->find($request->parent_id);
            $newpath = str_replace('/storage/', '', $newpath->feature_path);
        } else {
            $newpath = 'root';
        }
        $newfile = $newpath . '/' . $request->name . '.' . $this->fileManager->find($id)->extenstion;

        // thay doi tren server
        $this->storageTraitMoveFile($oldfile, $newfile);


        //Cap nhat database
        $this->fileManager->find($id)->update([
            'name' => $request->name . '.' . $this->fileManager->find($id)->extenstion,
            'feature_path' => '/storage/' . $newfile,
            'parent_id' => $this->fileManager->find($request->parent_id)->id
        ]);

        return redirect()->route('folder.selected', ['id' => $request->parent_id]);
    }


    public function downLoadFile($id)
    {
        $filedownload = $this->fileManager->find($id);
        if ($filedownload->type == 'file') {
            return Storage::download(str_replace('/storage/', '', $filedownload->feature_path));
        }
    }

    public function deleteFile($id)
    {
        try {
            DB::beginTransaction();

            $filedelete = $this->fileManager->find($id);
            $path = str_replace('/storage/', '', $filedelete->feature_path);
            if ($filedelete->type == 'file') {
                Storage::delete($path);
            } else {
                Storage::deleteDirectory($path);
            }
            $filedelete->getChild()->delete();
            $filedelete->delete();

            DB::commit();
            return response()->json([
                'code' => 200,
                'message' => 'success'
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

    public function deleteMultiFile(Request $request)
    {
        try {
            foreach ($request->arr_id as $id) {
                $this->deleteFile($id);
            }

            return response()->json([
                'code' => 200,
                'message' => 'success',
            ], 200);

        } catch (\Exception $exception) {
            Log::error('Message' . $exception->getMessage() . ' ------Line ' . $exception->getLine());

            return response()->json([
                'code' => 500,
                'message' => 'fail'
            ], 500);
        }
    }

    public function editDownLoadMultiFile(Request $request)
    {
        if ($request->checkCheck == 'checkDownload') {

            //down load multi file
            $zip = new ZipArchive();
            $fileName = 'app/myZip.zip';

            if (file_exists(storage_path($fileName))) {
                Storage::delete('myZip.zip');
            }

            if ($zip->open(storage_path($fileName), ZipArchive::CREATE) === TRUE) {

                foreach ($request->customCheck as $id) {
                    $file_down_load = $this->fileManager->find($id);
                    $file = File::get(storage_path(str_replace('/storage/', 'app/', $file_down_load->feature_path), $file_down_load->name));

                    $zip->addFromString('myZip/' . $file_down_load->name, $file);
                }

                $zip->close();

                return Storage::download('myZip.zip');
            }
        }
    }

}
