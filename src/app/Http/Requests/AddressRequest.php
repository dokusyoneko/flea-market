<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'postal_code'   => ['required', 'size:8'],
            'address'       => ['required', 'string', 'max:255'],
            'building_name' => ['nullable'],
        ];
    }

    public function messages()
    {
        return [
            'postal_code.required' => '郵便番号を入力してください。',
            'postal_code.size'     => '郵便番号は8文字で入力してください。',
            'address.required'     => '住所を入力してください。',
        ];
    }
}

