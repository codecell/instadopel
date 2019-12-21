<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    /**
     * disable restriction on user input
     */
    protected $guarded = [];

    /**
     * associate posts to user model
     */
    public function user() {
        return $this->belongsTo(User::class);
    }
}
