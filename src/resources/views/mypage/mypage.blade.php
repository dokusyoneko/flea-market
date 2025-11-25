@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="/css/mypage.css">
@endsection

@section('content')
<div class="profile__content">
    <div class="form__profile__image">
        <img src="/images/sample-profile.png" alt="" class="profile__image">
        <h2>{{ Auth::user()->name }}</h2>
        <a class="profile__image__button" href="/mypage/profile">プロフィールを編集</a>
    </div>
</div>
<div class="main__tab">
    <div class="main__tab__inner">
        <a class="main__tab--listing" href="/mypage">出品した商品</a>
        <a class="main__tab--purchase" href="/mypage">購入した商品</a>
    </div>
</div>
<div class="main__product">
    <div class="main__product--inner">
        <ul>
            @foreach($products as $product)
            <li>
                <a href="{{ route('item.show', ['item_id' => $product->id]) }}">
                    <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}">
                    <h3>{{ $product->name }}</h3>
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection