<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(){
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(){
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|regex:/^[a-zA-Z0-9]+$/'
        ];
    }

    public function messages(){
        return [
            'name.required' => 'ユーザーネームを入力してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレスの形式で入力してください',
            'email.unique' => '入力したメールアドレスはすでに使用されています',
            'password.required' => 'パスワードを入力してください',
            'password.min' => 'パスワードは8文字以上で入力してください',
            'password.regex:/^[a-zA-Z0-9]+$/' => 'パスワードは半角英数字で入力してください'
        ];
    }
}
