@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sell.css') }}">
@endsection

@section('content')
<div class="sell__content">
    <div class="product__title">
        <h2>商品の出品</h2>
    </div>
    <form class="form" action="/sell" method="post" enctype="multipart/form-data">
        @csrf
        <div class="product__img">
            <div class="product__img__title">
                <h3>商品画像</h3>
            </div>
            <div class="product__img__content">
                <label for="image_path" class="custom-file-label">画像を選択する</label>
                <input class="custom-file-input" type="file" id="image_path" name="image_path" accept="image/*" onchange="previewImage(event)">
                <img class="image-preview hidden" alt="選択された画像">
            </div>
            @error('image_path')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        <div class="product__detail">
            <h2>商品の詳細</h2>
            <h3>カテゴリー</h3>
            <div class="category__tags">
            @foreach($categories as $category)
                <label class="category__tag">
                    <input type="checkbox" name="categories[]" value="{{ $category->id }}">
                    <span>{{ $category->name }}</span>
                </label>
            @endforeach
                <input type="hidden" name="category" id="selected-category">
            </div>
            @error('categories')
                <div class="error-message">{{ $message }}</div>
            @enderror
            <h3>商品の状態</h3>
            <select class="product_condition" name="condition">
                <option value="" disabled selected>選択してください</option>
                <option>良好</option>
                <option>目立った傷や汚れなし</option>
                <option>やや傷や汚れあり</option>
                <option>状態が悪い</option>
            </select>
            @error('condition')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        <div class="product__description">
            <h2>商品名と説明</h2>
            <h3>商品名</h3>
            <input type="text" name="name">
            @error('name')
                <div class="error-message">{{ $message }}</div>
            @enderror
            <h3>ブランド名</h3>
            <input type="text" name="brand">
            <h3>商品の説明</h3>
            <textarea name="description" id=""></textarea>
            @error('description')
                <div class="error-message">{{ $message }}</div>
            @enderror
            <h3>販売価格</h3>
            <input type="text" name="price" value="{{ old('price') }}">
            @error('price')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        <div class="form__button">
            <button class="form__button-submit">出品する</button>
        </div>
    </form>
</div>

<script>
function previewImage(event) {
    const input = event.target;
    const preview = document.querySelector('.image-preview');

    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.src = '';
        preview.style.display = 'none';
    }
}
</script>
@endsection