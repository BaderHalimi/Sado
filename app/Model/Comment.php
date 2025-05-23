<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\User; // تأكد من استيراد النموذج من المسار الصحيح
use App\Model\UserRoom; // استيراد نموذج UserRoom إذا كان مطلوبًا
use App\Model\CommentLike; // استيراد نموذج UserRoom إذا كان مطلوبًا

class Comment extends Model
{
    protected $fillable = ['product_id', 'customer_id', 'comment', 'parent_id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

   public function user()
{
    return $this->belongsTo(User::class, 'customer_id');
}

 

 // في Comment.php (نموذج التعليق)
public function replies()
{
    return $this->hasMany(Comment::class, 'parent_id');
}
// في Comment.php (نموذج التعليق)
public function likes()
{
    return $this->hasMany(CommentLike::class);
}


}
