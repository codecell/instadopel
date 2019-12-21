<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model {
    // disable restriction on inputs
    protected $guarded = [];
    
    // Handle profile image space
    public function profileImage() {
        $imagePath = ($this->image) ? $this->image : 'profile/mL4jbj1WXpE9C7cMosw8TLfw4IzswQgdO3GCpRTa.jpeg';

        return '/storage/'.$imagePath;
    }

    //Associate profile to user
    public function user() {
        return $this->belongsTo(User::class);
    }

    // follow followers
    public function followers() {
        return $this->belongsToMany(User::class);
    }

}
