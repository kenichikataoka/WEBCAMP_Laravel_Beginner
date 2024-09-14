@extends('test.layout')
{{-- メインコンテンツ --}}
@section('contents')
    <h1>ログイン</h1>
    @if($errors->any())
        <div>
        @foreach($errors->all() as $error)
            {{ $error }}<br>
        @endforeach
        </div>
    @endif
    <form action="./test/input" method="post">
        @csrf
        {{-- 入力データの保持は{{ old('')}} と記載--}}
        email：<input name="email" value="{{ old('email') }}"><br>
        パスワード：<input name="password" type="password"><br>
        <button>ログインする</button>
    </form>
@endsection

