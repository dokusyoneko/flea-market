@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="/css/detail.css">
@endsection

@section('content')
<div class="main__left">
    @if($product->image_path)
        <img class="main__left__img" src="{{ asset('storage/' . $product->image_path) }}" alt="商品画像">
    @else
        <p>画像は登録されていません</p>
    @endif
</div>
<div class="main__right">
    <h2 class="main__right__name">{{ $product->name }}</h2>
    <div class="main__right__brand">{{ $product->brand }}</div>
    <div class="main__right__price">¥{{ number_format($product->price) }}(税込)</div>
    <div class="main__right__icons">
        <div class="icon-block">
            <img id="like-icon-{{ $product->id }}" src="{{ asset($product->likes->contains('user_id', auth()->id()) ? 'images/heart-active.png' : 'images/	heart-default.png') }}" alt="いいね" class="icon-heart" data-product-id="{{ $product->id }}"onclick="toggleLike({{ $product->id }})"/>
            <div class="icon-count" id="likes-count-{{ $product->id }}">{{ $product->likes->count() }}</div>
        </div>
        <div class="icon-block">
            <img src="{{ asset('images/comment-icon.png') }}" alt="コメント" class="icon-comment" />
            <div class="icon-count" id="comments-count-{{ $product->id }}">{{ $product->comments->count() }}</div>
        </div>
    </div>
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
        <div class="main__right__comment--img--name">
            <img class="comment-avatar" src="{{ $comment->user->profile && $comment->user->profile->avatar ? asset('storage/' . $comment->user->profile->avatar) : asset('images/default-avatar.png') }}" alt="user">
            <div class="main__right__user--name">{{ $comment->user->name }}</div>
        </div>
        <div class="main__right__user--comment">{{ $comment->content }}</div>
    </div>
    @endforeach
    <h4 class="main__right__subtitle--subtitle">商品へのコメント</h4>
    <form action="{{ route('products.comment', $product->id) }}" method="POST">
    @csrf
        @error('comment')
        <div class="form__error">{{ $message }}</div>
        @enderror
        <textarea class="main__right__comment--area" name="comment" >{{ old('comment') }}</textarea>
        <button type="submit" class="main__right__comment--button">コメントを送信する</button>
    </form>
</div>

<script>
    function toggleLike(productId) {
        fetch(`/products/${productId}/like`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            document.getElementById(`likes-count-${productId}`).innerText = data.likes_count; const icon = document.getElementById(`like-icon-${productId}`);
            icon.src = data.liked
                ? '/images/heart-active.png'
                : '/images/heart-default.png';
        });
    }
</script>

@endsection