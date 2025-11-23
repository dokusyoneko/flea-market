@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="/css/purchase.css">
@endsection

@section('content')
<div class="main__inner">
    <div class="main__left">
        <div class="left__item">
            <div class="left__item__img">
                <img class="left__item__img__--inner" src="{{ $product->image_path }}" alt="商品画像">
            </div>
            <div class="left__item__content">
                <h2>{{ $product->name }}</h2>
                <p>¥{{ $product->price }}</p>
            </div>
        </div>
        <div class="left__method">
            <div class="left__method__inner">
                <h3>支払い方法</h3>
                <select class="payment_method" name="payment_method" required>
                    <option value="disabled selected">選択してください</option>
                    <option value="convenience_store">コンビニ払い</option>
                    <option value="credit_card">カード支払い</option>
                </select>
            </div>
        </div>
        <div class="left__address">
            <div class="left__address__inner">
                <div class="address__inner__shipping">
                    <h3>配送先</h3>
                    <a href="{{ route('address.edit') }}">変更する</a>
                </div>
                <div class="address__inner__address">
                    <p>{{ $user_profile->postal_code }}</p>
                    <p>{{ $user_profile->address }}{{ $user_profile->building_name }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="main__right">
        <table>
            <tr>
                <td>商品代金</td>
                <td class="td__price">¥{{ $product->price }}</td>
            </tr>
            <tr>
                <td>支払い方法</td>
                <td>コンビニ支払い</td>
            </tr>
        </table>
        <a href="" class="purchase__button">購入する</a>
    </div>
</div>
@endsection