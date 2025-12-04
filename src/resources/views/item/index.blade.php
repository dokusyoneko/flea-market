@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="/css/index.css">
@endsection

@section('content')
<div class="main__tab">
    <div class="main__tab__inner">
        <a href="/?keyword={{ request('keyword') }}" class="{{ request()->query('data') === 'mypage' ? 'main__tab--black' : 'main__tab--favorite' }}">おすすめ</a>
        <a href="/?tab=mylist&keyword={{ request('keyword') }}" class="{{ request()->query('tab') === 'mylist' ? 'main__tab--favorite' : 'main__tab--mypage' }}">マイリスト</a>
    </div>
</div>
<div class="main__product">
    <div class="main__product--inner">
        <ul class="main__product--ul">
            @foreach($products as $product)
            <li class="main__product--li">
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