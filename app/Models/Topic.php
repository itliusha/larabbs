<?php

namespace App\Models;

class Topic extends Model
{
    protected $fillable = ['title', 'body', 'user_id', 'category_id', 'reply_count', 'last_reply_user_id', 'order', 'excerpt', 'slug'];

    // Category 模型关联
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // User 模型关联
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
