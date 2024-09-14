<?php

declare(strict_types=1);
namespace App\Http\Controllers;

// use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\TestPostRequest;

class TestController extends Controller
{
    //
    public function index() {
        return view('test.index');
    }

    // バリデーションは$requestのvalidationメソッドを使う
    // バリデーションの一般書式
    // $validate後のデータを受け取る変数 = $request->validate([
    // '項目名(nameアトリビュート値)' => ['validationルール', 'validationルール', ...],
    // '項目名(nameアトリビュート値)' => ['validationルール', 'validationルール', ...],
    // '項目名(nameアトリビュート値)' => ['validationルール', 'validationルール', ...],
    // ]);
    public function input(TestPostRequest $request) {
        $validatedData = $request->validated();
        // var_dump($validateData);
        // exit;
        return view('test.input',['datum'=>$validatedData]);
    }
}

