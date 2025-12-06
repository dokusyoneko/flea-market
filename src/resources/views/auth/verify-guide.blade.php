@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="/css/verify.css">
@endsection

@section('content')
<div class="verify__content">
    <div class="verify__content__inner">
        <h1 class="mb-3">メール認証が必要です</h1>
        <p class="mb-4">
            登録していただいたメールアドレスに認証メールを送付しました。<br>
            メール認証を完了してください。
        </p>
        <div class="verify__check">
                <a href="http://localhost:8025/#" class="verify__check__inner" target="_blank">
                    認証はこちらから
                </a>
        </div>
    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit" class="mail__resend__button">認証メールを再送する</button>
    </form>
    </div>
</div>
@endsection

