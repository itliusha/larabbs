<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class UserRequest extends FormRequest
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
        return [
            'name'              => 'required|between:3,25|regex:/^[A-Za-z0-9\-\_]+$/|unique:users,name,'. Auth::id(),
            'email'             => 'required|email',
            'introduction'      => 'max:150',
            'avatar'            => 'mimes:png,jpg,jpeg,gif|dimensions:min_width=400,min_height=400',
        ];
    }

    public function messages()
    {
        return [
            'name.required'     => '用户名为必填项',
            'name.regex'        => '用户名只支持英文、数字、‘-’、‘_’',
            'name.between'      => '用户名必须介于3-25个字符',
            'name.unique'       => '用户名已存在',
            'email.required'    => '电子邮箱不能为空',
            'email.email'       => '电子邮箱格式错误',
            'introduction'      => '个人简介不能超过80个字符',
            'avatar.mimes'      => '图片格式必须是png、jpg、jpeg、gif中的一种',
            'avatar.dimensions' => '图片的宽度需要在400px以上',

        ];
    }
}
