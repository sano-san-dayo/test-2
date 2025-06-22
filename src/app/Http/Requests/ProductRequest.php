<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->is('products/register')) {
            /* 商品登録用 */
            return [
                'name' => 'required',
                'price' => 'required | integer | min:0 | max:10000',
                'image' => 'required | mimes:jpeg,png',
                'description' => 'required | max:120',
                'seasons' => 'required',
            ];
        } elseif ($this->is('products/*/update')) {
            /* 商品更新用 */
            return [
                'name' => 'required',
                'price' => 'required | integer | min:0 | max:10000',
                'image' => 'nullable | mimes:jpeg,png',
                'description' => 'required | max:120',
                'seasons' => 'required',
            ];
        }
    }

    public function messages()
    {
        return [
            'name.required' => '商品名を入力してください',
            'price.required' => '値段を入力してくださ',
            'price.integer' => '数値で入力してください',
            'price.min' => '0～10000円以内で入力してください',
            'price.max' => '0～10000円以内で入力してください',
            'seasons.required' =>'季節を選択してください',
            'description.required' => '商品説明を入力してください',
            'description.max' => '120文字以内で入力してください',
            'image.required' => '商品画像を登録してください',
            'image.mimes' => '「.png」または「.jpeg」形式でアップロードしてください',
        ];
    }
}
