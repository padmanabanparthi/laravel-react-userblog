<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'users';

    /**
     * Get the posts for the user.
     */
    public function posts()
    {
        return $this->hasMany(Post::class,'user_id');
    }
}
