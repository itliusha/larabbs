<?php

namespace App\Handlers;

use Illuminate\Support\Str;

class ImageUploadHandler
{
    // 允许上传的图片格式
    protected $allowed_ext = ['png', 'gif', 'jpg', 'jpeg'];

    //保存图片
    public function save($file, $folder, $file_prefix)
    {
        // 图片路径规则
        $folder_name = "/upload/Images/$folder/" . date('Ym/d', time());

        // 图片存储的根路径
        $upload_path = public_path() . '/' . $folder_name;

        // 获取图片后缀名
        $extension = strtolower($file->getClientOriginalExtension()) ?: 'png';

        // 文件名
        $filename = $file_prefix . '_' . time() . '_' . Str::random(10) . '.' . $extension;

        // 如果上传的不是图片则终止上传操作
        if ( ! in_array($extension, $this->allowed_ext)) {
            return false;
        }

        // 移动图片至目标路径
        $file -> move($upload_path, $filename);

        return [
            'path'  => config('app.url') . "/$folder_name/$filename"
        ];
    }
}
