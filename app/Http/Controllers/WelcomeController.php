<?php

// 型を厳格にする
declare(strict_types=1);
// なぜ、名前空間を指定するのか？
// composerが提供しているオートローディングの機能を使用しているから
// ただし、オートローディング機能を使用するには、名前空間名とディレクトリ名が一致していないといけない。
// web.phpでWelcomeControllerクラスを使用しているので、クラス定義側の名前空間名(App\Http\Controllers)とディレクトリ(app/Http/Controllers)を一致させる必要がある)
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    //トップページを表示する
    public function index() {
        return view('welcome');
    }

    public function second() {
        return view('welcome_second');
    }
}
