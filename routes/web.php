<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TestController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// タスク管理システム
Route::get('/',[AuthController::class,'index'])->name('front.index');
Route::post('/login',[AuthController::class,'login']);
// Route::get('/task/list',[TaskController::class,'list']);

// 認可処理
Route::middleware(['auth'])->group(function(){
    Route::prefix('/task')->group(function(){
        Route::get('/list',[TaskController::class,'list']);
        Route::post('/register',[TaskController::class,'register']);
        // {task_id}は必須パラメータをURLに埋め込むときの書き方。コントローラ側で受け取ることができる
        // whereNumberはヘルパメソッドで、task_idは数字のみで構成されていることとするフォーマット制約
        // ->nameは名前付きルート
        Route::get('/detail/{task_id}',[TaskController::class,'detail'])->whereNumber('task_id')->name('detail');
        Route::get('/edit/{task_id}',[TaskController::class,'edit'])->whereNumber('task_id')->name('edit');
        Route::put('/edit/{task_id}',[TaskController::class,'editSave'])->whereNumber('task_id')->name('edit_save');
        Route::delete('/delete/{task_id}',[TaskController::class,'delete'])->whereNumber('task_id')->name('delete');
        Route::post('/complete/{task_id}',[TaskController::class,'complete'])->whereNumber('task_id')->name('complete');
    });

    Route::get('/logout',[AuthController::class,'logout']);

});


// form入力テスト用
Route::get('/test',[TestController::class,'index']);
// TestControllerクラスのinputメソッドを実施
Route::post('/test/input',[TestController::class,'input']);

// メソッド GET で / というURLにアクセスしたら、WelcomeController の indexメソッド（アクション）
// が実行されるというルールを示している。php artisan route:listで参照。
// 「クラス名とメソッド名の配列」を渡すと、Laravelが内部で「クラスのインスタンスを作成して、メソッドを実行」
Route::get('/welcome',[WelcomeController::class,'index']);
Route::get('/welcome/second',[WelcomeController::class,'second']);
