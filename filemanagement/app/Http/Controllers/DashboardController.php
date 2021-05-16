<?php

namespace App\Http\Controllers;

use App\FileManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class DashboardController extends Controller
{
    private $fileManager;

    public function __construct(FileManager $fileManager)
    {
        $this->fileManager = $fileManager;
    }

    public function index()
    {
        return view('admin.dashboard.index');
    }

    public function selectedCategory($id)
    {
        $listFiles = $this->fileManager->get();
        $listFilesNew = null;
        foreach ($listFiles as $file) {
            if ($file->type == 'file') {
                $ex = $file->extenstion;
                if ($id == 'images' && ($ex == 'jpg' || $ex == 'png')) {
                    $listFilesNew[] = $file;
                } elseif ($id == 'videos' && ($ex == 'mp4')) {
                    $listFilesNew[] = $file;
                } elseif ($id == 'documents' && ($ex == 'txt' || $ex == 'pptx' || $ex == 'pdf' || $ex == 'xlsx' || $ex == 'docx')) {
                    $listFilesNew[] = $file;
                } elseif ($id == 'other_files' && ($ex != 'txt' && $ex != 'pptx' && $ex != 'pdf' && $ex != 'xlsx' && $ex != 'mp4' && $ex != 'jpg' && $ex != 'png' && $ex != 'docx')) {
                    $listFilesNew[] = $file;
                }
            }
        }

        return view('admin.dashboard.index', compact('listFilesNew'));
    }

    public function download($id)
    {
        $filedownload = $this->fileManager->find($id);
        if ($filedownload->type == 'file') {
            return Storage::download(str_replace('/storage/', '', $filedownload->feature_path));
        }
    }

    public function delete($id)
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

    public function downLoadMultiFile(Request $request)
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

    public function deleteMultiFile(Request $request)
    {
        try {
            foreach ($request->arr_id as $id) {
                $this->delete($id);
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
}
