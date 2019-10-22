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

    // 帖子排序
    public function scopeWithOrder($query, $order)
    {
        switch ($order) {
            case 'recent':
                $query->recent();
                break;

            default:
                $query->recentReplied();
                break;
        }

        return $query->with('user', 'category');
    }

    // 按照更新时间排序
    public function scopeRecentReplied($query)
    {
        return $query->orderBy('updated_at', 'desc');
    }

    // 按照创建时间排序
    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}
