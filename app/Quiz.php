<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    /**
     * Relationships with users
     */
    public function author()
    {
        return $this->belongsTo(\App\User::class);
    }



    /**
     * Relationships with users (liked quizzes)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function likeds()
    {
        return $this->belongsToMany(User::class, 'likeds');
    }



    /**
     * Relationship with questions
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function questions()
    {
        return $this->hasMany(Question::class);
    }


    /**
     * @return int
     *
     * Unlikes a quiz for a given user
     */
    public function unlike()
    {
        return $this->likeds()->detach();
    }
}
