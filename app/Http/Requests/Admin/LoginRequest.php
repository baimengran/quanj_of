<?php

namespace App\Http\Requests\Admin;


class LoginRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'username'=>'required|string',
            'password'=>'required|min:6|max:32'
        ];
    }


    public function messages(){
        return [
            'username.required'=>'请输入用户名',
            'username.string'=>'用户名包含非法字符',
            'password.required'=>'请输入密码',
            'password.min'=>'请输入6-32位密码',
            'password.max'=>'请输入6-32位密码',
        ];
    }
}
