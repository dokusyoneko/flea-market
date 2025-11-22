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
<div class="main__product">
    <div class="main__product--inner">
        <ul>
            @foreach($products as $product)
            <li>
                <a href="{{ route('item.show', ['item_id' => $product->id]) }}">
                    <img src="{{ $product->image_path }}" alt="{{ $product->name }}">
                    <h3>{{ $product->name }}</h3>
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection