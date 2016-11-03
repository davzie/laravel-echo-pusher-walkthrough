<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $fillable = ['user_id','posts_id','comment'];

    protected $appends = ['username'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getUsernameAttribute()
    {
        return $this->user->email;
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

}
