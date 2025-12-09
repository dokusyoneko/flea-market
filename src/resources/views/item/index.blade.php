@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="/css/index.css">
@endsection

@section('content')
<div class="main__tab">
    <div class="main__tab__inner">
        <a href="/?keyword={{ request('keyword') }}"class="{{ request()->query('tab') === 'recommend' || !request()->has('tab') ? 'main__tab--favorite' : 'main__tab--black' }}">おすすめ</a>
        <a href="/?tab=mylist&keyword={{ request('keyword') }}"  class="{{ request()->query('tab') === 'mylist' ? 'main__tab--favorite' : 'main__tab--black' }}">マイリスト</a>
    </div>
</div>
<div class="main__product">
    <div class="main__product--inner">
        <ul class="main__product--ul">
            @foreach($products as $product)
            <li class="main__product--li">
                <a href="{{ route('item.show', ['item_id' => $product->id]) }}">
                    <div class="product-image-wrapper">
                        @if(Str::startsWith($product->image_path, 'http'))
                            <img src="{{ $product->image_path }}" alt="{{ $product->name }}">
                        @else
                            <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}">
                        @endif
                        @if($product->is_sold)
                            <span class="sold-label">SOLD</span>
                        @endif
                    </div>
                    <h3>{{ $product->name }}</h3>
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection