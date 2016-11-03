<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function isVisible()
    {
        $authed = \Auth::user();

        if (!$this->isPrivate()) {
            return true;
        }

        if (!$authed) {
            return false;
        }

        return $this->user_id == $authed->id;
    }

    public function isPrivate()
    {
        return $this->private ? true : false;
    }

}
