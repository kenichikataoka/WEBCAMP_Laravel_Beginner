<?php

declare(strict_types=1);
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\TaskRegisterPostRequest;
use App\Models\Task as TaskModel;

class TaskController extends Controller
{
    //
    public function list(){

        // 1pageあたりの表示アイテム数を設定
        $per_page = 2;

        // Modelクラス名::get()はそのテーブルの全件を取得
        $list = TaskModel::where('user_id',Auth::id())
                        ->orderBy('priority','DESC')
                        ->orderBy('period')
                        ->orderBy('created_at')
                        ->paginate($per_page);
                        // ->get();
        // $sql = TaskModel::where('user_id',Auth::id())->orderBy('priority','DESC')->tosql();
        // echo "<pre>\n";
        // var_dump($sql);
        // exit;
        // Laravelのテンプレートをviewで返す場合、フォルダ名.ファイル名とする。
        return view('task.list',['list'=>$list]);

    }

    public function detail($task_id){
        // var_dump($task_id);
        // exit;
        $task = TaskModel::find($task_id);
        if($task===NULL){
            return redirect('/task/list');
        }
        if($task->user_id!==Auth::id()){
            return redirect('/task/list');
        }

        return view('task.detail',['task'=>$task]);

    }

    public function register(TaskRegisterPostRequest $request){
        $datum = $request->validated();
        // $user = Auth::user();
        // $id = Auth::id();
        // var_dump($datum, $user, $id);
        // exit;
        $datum['user_id'] = Auth::id();
        try {
            $r = TaskModel::create($datum);
            // var_dump($r);
            // exit;
        } catch(\Throwable $e) {
            echo $e->getMessage();
            exit;
        }

        $request->session()->flash('front.task_register_success', true);

        return redirect('/task/list');

    }
}
