<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'question_id', 'answer'];

    /**
     * Get the answers for the question.
     */
    public function comment()
    {
        return $this->hasMany('App\Comment');
    }

    /**
     * Get the question that owns the answer.
     */
    public function question()
    {
        return $this->belongsTo('App\Question');
    }

    /**
     * Get the user that owns the answer.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
