<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
     /**
     * Get the user that owns the posts.
     */
    public function member()
    {
        return $this->belongsTo('App\Member','user_id');
    }
}
