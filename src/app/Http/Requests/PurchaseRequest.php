<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'payment_method' => ['required', 'in:convenience_store,credit_card'],
            'address_id' => ['required', 'exists:user_profiles,id'],
        ];
    }

    public function messages()
    {
        return [
            'payment_method.required' => '支払い方法を選択してください。',
            'payment_method.in'       => '支払い方法はコンビニ支払いまたはカード支払いを選択してください。',
            'address_id.required'     => '配送先を選択してください。',
            'address_id.exists'       => '選択した配送先が存在しません。',
        ];
    }
}

