@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="/css/index.css">
@endsection

@section('content')
<div class="main__tab">
    <div class="main__tab__inner">
        <a href="/?keyword={{ request('keyword') }}" class="{{ request()->query('data') === 'mypage' ? 'main__tab--black' : 'main__tab--favorite' }}">おすすめ</a>
        <a href="/?data=mypage&keyword={{ request('keyword') }}" class="{{ request()->query('data') === 'mypage' ? 'main__tab--favorite' : 'main__tab--mypage' }}">マイリスト</a>
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