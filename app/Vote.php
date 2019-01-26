<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'votetable_type', 'votetable_id', 'vote'];

    /**
     * Get the user that owns the vote.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get all of the owning votes models.
     */
    public function votetable()
    {
        return $this->morphTo();
    }
}
