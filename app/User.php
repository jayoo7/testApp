<?php
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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
     * Get the questions for the user.
     */
    public function question()
    {
        return $this->hasMany('App\Question');
    }

    /**
     * Get the answers for the user.
     */
    public function answer()
    {
        return $this->hasMany('App\Answer');
    }

    /**
     * Get the comments for the user.
     */
    public function comment()
    {
        return $this->hasMany('App\comment');
    }

    /**
     * Get the votes for the user.
     */
    public function vote()
    {
        return $this->hasMany('App\Vote');
    }



    /** 
     * For implement JWT.
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
