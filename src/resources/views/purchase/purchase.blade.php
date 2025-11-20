@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="/css/purchase.css">
@endsection

@section('content')
<div class="main__inner">
    <div class="main__left">
        <div class="left__item">
            <img class="main__left__img" src="{{ $product->image_path }}" alt="商品画像">
            <h2>{{ $product->name }}</h2>
            <p>¥{{ $product->price }}</p>
        </div>
        <div class="left__method">
            <h3>支払い方法</h3>
            <select id="payment_method" name="payment_method" required>
                <option value="disabled selected">選択してください</option>
                <option value="convenience_store">コンビニ払い</option>
                <option value="credit_card">クレジットカード</option>
                <option value="bank_transfer">銀行振込</option>
            </select>
        </div>
        <div class="left__address">
            <h3>配送先</h3>
            <a href="">変更する</a>
            <p>郵便番号</p>
            <p>住所</p>
        </div>
    </div>
    <div class="main__right">
        <table>
            <tr>
                <td>商品代金</td>
                <td>金額</td>
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