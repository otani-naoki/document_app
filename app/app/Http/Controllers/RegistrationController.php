<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Illuminate\support\Facades\DB;

use Carbon\Carbon;

use App\Project;
use App\Folder;
use App\Document;
use App\Like;    
use App\User; 
use Illuminate\support\Facades\Auth;

use Illuminate\Support\Facades\Storage; //Storageを使用するための宣言

//モデルを呼び出す（設計図を取得する）→　Controllerでインスタンス化

class RegistrationController extends Controller
{

public function guide(Request $request) {
    // ディレクトリ名(Storageに作成したフォルダ名)
    $dir = 'files';

    // アップロードされたファイル名を取得（ダウンロードの際にも使う（名前継承））
    $file_name = $request->file('pdf')->getClientOriginalName();

    // 取得したファイル名で保存
    $request->file('pdf')->storeAs('public/' . $dir, $file_name);

    $guide = Storage::get();
    
    return view('guide',['guideName'=>$file_name]);

} 

//---Project追加によるデータ格納---
public function saveProject(Request $request){

    $user=Auth::user(); //ログインユーザーの情報を全て取得

    $project = new Project;
    $project->title = $request->projectName;
    $project->user_id = $request->id;
    $project->date = $request->startDate;
    $project->object = $request->projectObject;
    $project->memo = $request->projectDescription;
    $project->save();

    $project = new Project;
    $projectShow = $project->all()->toArray();

    return view('project', ['projectItems'=>$projectShow, 'user'=> $user]);
}

//---Folder追加によるデータ格納---
public function saveFolder(Request $request, int $projectId){
    $user=Auth::user(); //ログインユーザーの情報を全て取得

    $folder = new Folder;
    $folder->title=$request->folderName;
    $folder->user_id=$user->id;
    $folder->project_id=$projectId;
    $folder->save();

    $folder = new Folder;
    $folderName =  $folder->where('project_id', $projectId)->get();

    $project = new Project;
    $selectedProject = $project->find($projectId);

    return view('folder', [
        'folders'=>$folderName,
        'projectName'=>$selectedProject, 
        'user'=>$user
    ]);
}

public function saveFile(Request $request){
    $user=Auth::user(); //ログインユーザーの情報を全て取得
    $fileName=$request->file('upload_file')->getClientOriginalName();
    $request->file('pdf')->storeAs('public/files/',$fileName);
    
    $document = new Document;
    $document->file = $fileName;
    $document->title = $fileName;
    $document->date = $request->documentDate;
    $document->memo = $request->documentDescription;
    $document->folder_id = $request->select_folder;
    $document->user_id = $user->id;
    $document->save();

    $project = new Project;
    $projectShow = $project->all()->toArray();

    return view('project', ['projectItems'=>$projectShow, 'user'=> $user]);
}

}
