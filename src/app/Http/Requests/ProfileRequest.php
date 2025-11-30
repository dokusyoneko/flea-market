<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'avatar'      => ['nullable', 'image', 'mimes:jpeg,png'],
            'username'        => ['required', 'string', 'max:20'],
            'postal_code' => ['required', 'size:8'],
            'address'     => ['required', 'string', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'avatar.image'  => 'プロフィール画像は画像ファイルを選択してください。',
            'avatar.mimes'  => 'プロフィール画像はjpegまたはpng形式でアップロードしてください。',
            'username.required' => 'ユーザー名を入力してください。',
            'username.max'      => 'ユーザー名は20文字以内で入力してください。',
            'postal_code.required' => '郵便番号を入力してください。',
            'postal_code.size' => '郵便番号は8文字で入力してください。',
            'address.required'     => '住所を入力してください。',
        ];
    }
}

