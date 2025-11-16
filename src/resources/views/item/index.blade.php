@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="/css/index.css">
@endsection

@section('content')
<div class="main__tab">
    <div class="main__tab__inner">
        <a class="main__tab--favorite" href="/login">おすすめ</a>
        <a class="main__tab--mylist" href="/mypage">マイリスト</a>
    </div>
</div>
<div>
    <ul>
        <li>
            <img src="" alt="">
            <h3>商品名</h3>
        </li>
    </ul>
</div>
@endsection