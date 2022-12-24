<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Illuminate\support\Facades\DB;

use Carbon\Carbon;
use App\Document;
use Illuminate\Support\Facades\Storage; //Storageを使用するための宣言

class DownloadController extends Controller
{

    public function guide(){
        
        return Storage::download('public/files/UserGuide_YYYYMMDD.pdf');
    }

    public function file(int $fileId){

        $fileName = Document::where('id', $fileId)->get('file');
        return Storage::download('public/files/'.$fileName[0]->file);
    }

}