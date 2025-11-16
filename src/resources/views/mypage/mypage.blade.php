@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="/css/mypage.css">
@endsection

@section('content')
<div class="profile__content">
    <div class="form__profile__image">
        <img src="/images/sample-profile.png" alt="" class="profile__image">
        <h2>ユーザー名</h2>
        <a class="profile__image__button">プロフィールを編集</a>
    </div>
</div>
<div class="main__tab">
    <div class="main__tab__inner">
        <a class="main__tab--favorite" href="/login">出品した商品</a>
        <a class="main__tab--mylist" href="/mypage">購入した商品</a>
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