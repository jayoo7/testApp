<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id','question'];

    /**
     * Get the answers for the question.
     */
    public function answer()
    {
        return $this->hasMany('App\Answer');
    }

    /**
     * Get the user that owns the question.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get all of the question's votess.
     */
    public function votes()
    {
        return $this->morphMany('App\Vote', 'votetable');
    }
}
