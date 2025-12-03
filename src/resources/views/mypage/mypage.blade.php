@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="/css/mypage.css">
@endsection

@section('content')
<div class="profile__content">
    <div class="form__profile__image">
        <img src="{{ optional(Auth::user()->profile)->avatar ? asset('storage/' . Auth::user()->profile->avatar) : asset('images/default-avatar.png') }}" alt="プロフィール画像"  class="profile__image">

        <h2>{{ Auth::user()->name }}</h2>
        <a class="profile__image__button" href="/mypage/profile">プロフィールを編集</a>
    </div>
</div>
<div class="main__tab">
    <div class="main__tab__inner">
        <a href="{{ route('mypage.index', ['page' => 'sell']) }}" class="{{ request()->query('page') !== 'sell' ? 'active-tab' : '' }}">出品した商品</a>
        <a href="{{ route('mypage.index', ['page' => 'buy']) }}" class="{{ request()->query('page') === 'buy' ? 'active-tab' : '' }}">購入した商品</a>
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
                @if($product->is_sold)
                    <span class="sold-label">SOLD</span>
                @endif
            </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection