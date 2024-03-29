<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function likedPosts()
    {
        return $this->belongsToMany(Post::class, 'likes');
    }

    //この投稿に対して既にlikeしたかどうかを判別する
    public function isLike($postId)
    {
        return $this->likedPosts()->where('post_id',$postId)->exists();
    }

    //isLikeを使って、既にlikeしたか確認したあと、いいねする（重複させない）
    public function like($postId)
    {
        $exist = $this->isLike($postId);

        if($exist){
            return false;
        } else {
            $this->likedPosts()->attach($postId);
            return true;
        }
    }

    //isLikeを使って、既にlikeしたか確認して、もししていたら解除する
    public function unlike($postId)
    {
        $exist = $this->isLike($postId);

        if($exist){
            $this->likedPosts()->detach($postId);
            return true;
        } else {
            return false;
        }
    }

}
