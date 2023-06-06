<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image_path',
        'comment',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes');
    }

    public function isLikedByUser($user_id)
    {
        return $this->likes()->where('user_id', $user_id)->exists();
    }
}
