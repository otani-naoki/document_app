<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Project;
use App\Folder;
use App\Document;

class AjaxController extends Controller
{
    //
    public function destroyProject(Request $request) {

        //ajaxメソッドから送信されたデータは$requestに格納されます
        //ajas側で送信したデータの名前は"id"という名前に設定しているため
        //コントローラーで使うには $request->id で出力します
             
            $project = Project::findOrFail($request->id);
        //データベースのUsersテーブルから()で指定されたiDのレコードを代入します
            $project->delete();
        //usersに代入されているレコード（行）を削除します
            }

    public function selectFolder(Request $request){
        $folders=Folder::where('project_id', $request->project_id)->get();

        return $folders;
        
    }
}
