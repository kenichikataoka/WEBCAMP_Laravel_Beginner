<?php

declare(strict_types=1);
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginPostRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function index() {
        return view('index');
    }

    public function login(LoginPostRequest $request) {
        $datum = $request->validated();
        // var_dump($datum);
        // exit;

        // 認証に失敗した場合
        if(Auth::attempt($datum)===false){
            return back()
                ->withInput() //入力値の保持
                ->withErrors(['auth'=>'emailかパスワードに誤りがあります',]);
        }

        // 認証に成功した場合
        $request->session()->regenerate();
        return redirect()->intended('/task/list');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->regenerateToken();
        $request->session()->regenerate();
        return redirect(route('front.index'));
    }
}