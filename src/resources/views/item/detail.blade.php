@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="/css/detail.css">
@endsection

@section('content')
<div class="main__left">
    <img class="main__left__img" src="{{ $product->image_path }}" alt="商品画像">
</div>
<div class="main__right">
    <h2 class="main__right__name">{{ $product->name }}</h2>
    <div class="main__right__brand">{{ $product->brand }}</div>
    <div class="main__right__price">¥{{ $product->price }}(税込)</div>
    <i class="fa-regular fa-heart"></i>
    <i class="fa-regular fa-comment"></i>
    <a href="{{ route('purchase.show', ['item_id' => $product->id]) }}" class="main__right__purchase--button">
        購入手続きへ
    </a>
    <h3 class="main__right__subtitle--info">商品説明</h3>
    <p class="main__right__description">{{ $product->description }}</p>
    <h3 class="main__right__subtitle--description">商品の情報</h3>
    <div class="category__class">
        <h4 class="main__right__subtitle--sub">カテゴリー</h4>
        <div class="categories">
            @foreach($product->categories as $category)
            <div class="main__right__category">{{ $category->name }}</div>
            @endforeach
        </div>
    </div>
    <div class="condition__class">
        <h4 class="main__right__subtitle--sub">商品の状態</h4>
        <div  class="conditions">
            <div class="main__right__condition">{{ $product->condition }}</div>
        </div>
    </div>
    <h3 class="main__right__subtitle--comment">コメント({{ $product->comments->count() }})</h3>
    @foreach($product->comments as $comment)
    <div class="main__right__comment">
        <img src="{{ $user_profile->avatar }}" alt="admin">
        <div class="main__right__user--name">{{ $comment->user->name }}</div>
        <div class="main__right__user--comment">{{ $comment->content }}</div>
    </div>
    @endforeach
    <h4 class="main__right__subtitle--subtitle">商品へのコメント</h4>
    <textarea class="main__right__comment--area" name="" id=""></textarea>
    <button class="main__right__comment--button">コメントを送信する</button>
</div>
@endsection