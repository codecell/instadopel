<?php

namespace App;

use App\Mail\NewUserWelcomeMail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;

// use App\Profile;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'username', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Hook user model to an event, gets called when this model is about to load
     */
    protected static function boot() 
    {
        // call parent boot
        parent::boot();

        // a lifecycle hook, gets called when user is *CREATED*
        static::created(function ($user) {
            $user->profile()->create([
                'title'=>$user->username
            ]);

            Mail::to($user->email)->send(new NewUserWelcomeMail());
        });
    }    

    /**
     * create association with profiles table
     */

     public function profile()
     {
        return $this->hasOne(Profile::class);
     }

     /**
      * associate posts to users
      */
     public function posts()
     {
        return $this->hasMany(Post::class)->orderBy('created_at', 'DESC');
     }

     /**
      * follow another user
      */
     public function following() {
        return $this->belongsToMany(Profile::class);
     } 
}
