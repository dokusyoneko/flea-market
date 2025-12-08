@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="/css/purchase.css">
@endsection

@section('content')
<div class="main__inner">
    <div class="main__left">
        <div class="left__item">
            <div class="left__item__img">
                @if(Str::startsWith($product->image_path, 'http'))
                        <img class="left__item__img__--inner" src="{{ $product->image_path }}" alt="{{ $product->name }}">
                    @else
                        <img class="left__item__img__--inner" src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}">
                    @endif
            </div>
            <div class="left__item__content">
                <h2>{{ $product->name }}</h2>
                <p>¥{{ number_format($product->price) }}</p>
            </div>
        </div>
        <div class="left__method">
            <div class="left__method__inner">
                <h3>支払い方法</h3>
                <select class="payment_method" name="payment_method" id="payment-method" required>
                    <option value="" disabled selected>選択してください</option>
                    <option value="konbini">コンビニ払い</option>
                    <option value="card">カード支払い</option>
                </select>
                @error('payment_method')
                    <div class="form__error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="left__address">
            <div class="left__address__inner">
                <div class="address__inner__shipping">
                    <h3>配送先</h3>
                    <a href="{{ route('address.edit', ['item_id' => $product->id]) }}">変更する</a>
                </div>
                <div class="address__inner__address">
                    <p>〒{{ $user_profile->postal_code }}</p>
                    <p>{{ $user_profile->address }}{{ $user_profile->building_name }}</p>
                </div>
                @error('address_id')
                    <div class="form__error">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="main__right">
        <table>
            <tr>
                <td>商品代金</td>
                <td class="td__price">¥{{ number_format($product->price) }}</td>
            </tr>
            <tr>
                <td>支払い方法</td>
                <td id="selected-method">コンビニ支払い</td>
            </tr>
        </table>
        <form action="{{ route('purchase.checkout', ['item_id' => $product->id]) }}" method="POST">
        @csrf
            <input type="hidden" name="payment_method" id="hidden-payment-method">
            <input type="hidden" name="address_id" value="{{ $user_profile->id }}">
            <button type="submit" class="purchase__button">購入する</button>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const select = document.getElementById('payment-method');
    const display = document.getElementById('selected-method');
    const hiddenInput = document.getElementById('hidden-payment-method');

    const labels = {
        konbini: 'コンビニ支払い',
        card: 'カード支払い',
    };

    select.addEventListener('change', function () {
        const code = select.value;
        display.textContent = labels[code] || '選択してください';
        hiddenInput.value = code;
    });
});
</script>
@endsection