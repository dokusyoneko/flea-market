<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExhibitionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'        => ['required', 'string', 'max:100'],
            'description' => ['required', 'string', 'max:255'],
            'image_path'  => ['required', 'image', 'mimes:jpeg,png'],
            'categories'   => ['required', 'array'],
            'categories.*' => ['exists:categories,id'],
            'condition'   => ['required'],
            'price'       => ['required', 'integer', 'min:0'],
        ];
    }

    public function messages()
    {
        return [
            'name.required'        => '商品名を入力してください。',
            'description.required' => '商品説明を入力してください。',
            'description.max'      => '商品説明は255文字以内で入力してください。',
            'image_path.required'       => '商品画像をアップロードしてください。',
            'image_path.image'     => '商品画像は画像ファイルを選択してください。',
            'image_path.mimes'     => '商品画像はjpegまたはpng形式でアップロードしてください。',
            'categories.required'  => '商品のカテゴリーを選択してください。',
            'categories.*.exists'  => '選択したカテゴリーが存在しません。',
            'condition.required'   => '商品の状態を選択してください。',
            'price.required'       => '商品価格を入力してください。',
            'price.integer'        => '商品価格は数値で入力してください。',
            'price.min'            => '商品価格は0円以上で入力してください。',
        ];
    }
}

