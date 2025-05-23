<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Comment;


class UserRoom extends Model
{
    protected $casts = [
        'user_id' => 'int',
        'room_id' => 'int',
    ];

    protected $table = "user_room";

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }
    public function comments()
{
    return $this->hasMany(Comment::class);
}

}
