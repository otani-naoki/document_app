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

//モデルを呼び出す（設計図を取得する）→　Controllerでインスタンス化

class DisplayController extends Controller
{

    public function index(){
        return view ('guide');
    }

    public function documentList(){
        $user = Auth::user(); //ログインユーザーの情報を全て取得
        $document = Document::all()->toArray();
        return view ('documents',['user'=>$user,'documents'=>$document]);
    }

    public function favoriteList(){
        $user = Auth::user(); //ログインユーザーの情報を全て取得

        // ユーザー一覧をページネートで取得
        $documents = Document::join('likes', 'documents.id', '=', 'likes.document_id')
        ->get();
        return view ('home',['user'=>$user,'favorites'=>$documents]);
    }
    
    public function projectList(){
        $user=Auth::user(); //ログインユーザーの情報を全て取得
        $project = new Project;
        $projectShow = $project->all()->toArray();
        return view ('project',['projectItems'=>$projectShow, 'user'=> $user]);
    }

    public function addProject(){
        $user=Auth::user(); //ログインユーザーの情報を全て取得
        return view ('add_project',['user'=> $user]);
    }

    public function createFile(){
        $user=Auth::user(); //ログインユーザーの情報を全て取得

        $now = Carbon::now();
        $now_format = $now->format('Y-m-d');

        $project = new Project;
        $selectProject = $project->get();
    
        $folder = new Folder;
        $selectFolder = $folder->get();

        return view ('create_file',['user'=> $user, 'selectProjects'=>$selectProject,'selectFolders'=>$selectFolder, 'today'=>$now_format]);
    }

    public function folderPage(int $projectId){
        $user=Auth::user();

        $selectedProject = Project::find($projectId);
    
        
        $folder = new Folder;
        $folderName =  $folder->where('project_id', $projectId)->get();
        // $s = Folder::find(76);
        // dd($s->documents);
        
        $document = new Document;
        $documentName = $document->get(); //修正必要

        return view ('folder', [
            'projectName'=>$selectedProject,
            'folders'=>$folderName,
            'documents'=>$documentName,
            'user'=>$user,
        ]);
    }

    public function editView(int $id){
        $project=Project::findOrFail($id);
        $user=Auth::user();
        return view ('editProject',[
            'project'=>$project,
            'user'=>$user,
        ]);
    }

    public function updateView(Request $request, int $id){
        $project=Project::findOrFail($id);
        $project->object=$request->projectObject;
        $project->memo=$request->projectDescription;
        $project->save();
        return redirect()->route('projectLink');
    }

    public function documentPage(int $documentId){
        $user=Auth::user();

        $document = new Document;
        $documentName =  $document->find($documentId);

        $like=Like::where('user_id',Auth::id())->where('document_id',$document->id);

        return view('file', [
            'document'=>$documentName,
            'user'=>$user,
            'like'=>$like,

        ]);
    }

    public function searchDocuments(Request $request){
        $user = Auth::user(); //ログインユーザーの情報を全て取得

        // ユーザー一覧をページネートで取得
        $documents = Document::all();

            $search = $request->input('search');
    
            // クエリビルダ
            $query = Document::query();
    
            // もし検索フォームにキーワードが入力されたら
            if ($search) {
    
                // 全角スペースを半角に変換
                $spaceConversion = mb_convert_kana($search, 's');
    
                // 単語を半角スペースで区切り、配列にする（例："山田 翔" → ["山田", "翔"]）
                $wordArraySearched = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);
    
    
                // 単語をループで回し、ユーザーネームと部分一致するものがあれば、$queryとして保持される
                foreach($wordArraySearched as $value) {
                    $query->where('title', 'like', '%'.$value.'%');
                }
    
                $documents = $query->get();

            }

        return view ('documents',['user'=>$user,'documents'=>$documents]);
    }

    public function searchFavorites(Request $request){
        $user = Auth::user(); //ログインユーザーの情報を全て取得

        // ユーザー一覧をページネートで取得
        $documents = Document::join('likes', 'documents.id', '=', 'likes.document_id')
        ->select(
            'documents.id',
            'documents.title'
            )
        ->get();

            $search = $request->input('search');
    
            // クエリビルダ
            $query = Document::join('likes', 'documents.id', '=', 'likes.document_id')->getQuery();
    
            // もし検索フォームにキーワードが入力されたら
            if ($search) {
    
                // 全角スペースを半角に変換
                $spaceConversion = mb_convert_kana($search, 's');
    
                // 単語を半角スペースで区切り、配列にする（例："山田 翔" → ["山田", "翔"]）
                $wordArraySearched = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);
    
    
                // 単語をループで回し、ユーザーネームと部分一致するものがあれば、$queryとして保持される
                foreach($wordArraySearched as $value) {
                    $query->where('documents.title', 'like', '%'.$value.'%');
                }
    
                $documents = $query->get();

            }

        return view ('home',['user'=>$user,'favorites'=>$documents]);
    }

}