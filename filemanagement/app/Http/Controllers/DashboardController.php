<?php

namespace App\Http\Controllers;

use App\FileManager;
use Illuminate\Http\Request;

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
        foreach ($listFiles as $file) {
            if ($file->type == 'file') {
                $ex = $file->extenstion;
                if ($id == 'images' && ($ex == 'jpg' || $ex == 'png')) {
                    $listFilesNew[] = $file;
                } elseif ($id == 'videos' && ($ex == 'mp4')) {
                    $listFilesNew[] = $file;
                } elseif ($id == 'documents' && ($ex == 'txt' || $ex == 'pptx' || $ex == 'pdf' || $ex == 'xlsx' || $ex =='docx')) {
                    $listFilesNew[] = $file;
                } elseif ($id == 'other_files' && ($ex != 'txt' && $ex != 'pptx' && $ex != 'pdf' && $ex != 'xlsx' && $ex != 'mp4' && $ex != 'jpg' && $ex != 'png' && $ex !='docx')) {
                    $listFilesNew[] = $file;
                }
            }
        }

        return view('admin.dashboard.index', compact('listFilesNew'));
    }
}
