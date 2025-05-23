<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Comment;
use App\Models\User; // تأكد من استيراد النموذج من المسار الصحيح


class CommentLike extends Model
{
    protected $fillable = ['comment_id', 'customer_id'];

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
}
