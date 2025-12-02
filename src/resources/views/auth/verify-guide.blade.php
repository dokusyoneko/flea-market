@extends('layouts.app')

@section('content')
<div class="container" style="max-width:640px;">
    <h1 class="mb-3">メール認証が必要です</h1>
    <p class="mb-4">
        登録していただいたメールアドレスに認証メールを送付しました。<br>
        メール認証を完了してください。
    </p>
    <a href="http://localhost:8025/#" class="btn btn-primary mb-3" target="_blank">
        認証はこちらから
    </a>
    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit" class="btn btn-link">認証メールを再送する</button>
    </form>
    @if (session('status') === 'verification-link-sent')
        <div class="alert alert-success mt-3">
            認証メールを再送しました。メールをご確認ください。
        </div>
    @endif
</div>
@endsection

