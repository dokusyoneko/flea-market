@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="/css/profile.css">
@endsection

@section('content')
<div class="profile__content">
    <div class="profile-form__heading">
        <h2>プロフィール設定</h2>
    </div>
    <form class="form" action="{{ route('mypage.update') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form__group">
            <div class="form__profile__image">
                <label for="avatar">
                    <img id="avatar-preview" src="{{ $profile && $profile->avatar ? asset('storage/' . $profile->avatar) : asset('images/default-avatar.png') }}" alt="アバター画像" class="profile__image">
                </label>
                <input type="file" name="avatar" id="avatar" accept="image/*" class="profile__image__input">
            </div>
            <div class="form__group-title">
                <span class="form__label--item">ユーザー名</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="username" value="{{ old('username', $profile->username ?? '') }}" />
                </div>
                <div class="form__error">
                    @error('username')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">郵便番号</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="postal_code" value="{{ old('postal_code', $profile->postal_code ?? '') }}" />
                </div>
                <div class="form__error">
                    @error('postal_code')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">住所</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="address" value="{{ old('address', $profile->address ?? '') }}" />
                </div>
                <div class="form__error">
                    @error('address')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">建物名</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="building_name" value="{{ old('building_name', $profile->building_name ?? '') }}" />
                </div>
                <div class="form__error">
                    @error('building_name')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">更新する</button>
        </div>
    </form>
</div>

<script>
document.getElementById('avatar').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = function(e) {
        document.getElementById('avatar-preview').src = e.target.result;
    };
    reader.readAsDataURL(file);
});
</script>
@endsection