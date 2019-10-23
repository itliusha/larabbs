<?php

namespace App\Http\Requests;

class TopicRequest extends Request
{
    public function rules()
    {
        switch($this->method())
        {
            // CREATE
            case 'POST':
            // UPDATE
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'title'       => 'required|min:2',
                    'body'        => 'required|min:3',
                    'category_id' => 'required|numeric',
                ];
            }
            case 'GET':
            case 'DELETE':
            default:
            {
                return [];
            };
        }
    }

    public function messages()
    {
        return [
            'title.min' => '标题必须至少两个字符',
            'body.min' => '文章内容必须至少三个字符',
        ];
    }
    // public function rules()
    // {
    //     switch($this->method())
    //     {
    //         // CREATE
    //         case 'POST':
    //         // UPDATE
    //         case 'PUT':
    //         case 'PATCH':
    //         {
    //             return [
    //                 'title'       => 'required|min:2',
    //                 'body'        => 'required|min:3',
    //                 'category_id' => 'required|numeric',
    //             ];
    //         }
    //         case 'GET':
    //         case 'DELETE':
    //         default:
    //         {
    //             return [];
    //         };
    //     }
    // }

    // public function messages()
    // {
    //     return [
    //         'title.required'        => '标题不能为空',
    //         'title.min'             => '标题不能少于三个字符',
    //         'body.required'         => '内容不能为空'，
    //         'body.min'              => '内容不能少于三个字符',
    //     ];
    // }
}
