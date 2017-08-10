<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{

    protected $fillable = ['author_id', 'category_id', 'title', 'description', 'picture', 'premium', 'views'];
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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     *
     * Relationships with photos
     */
    public function photo()
    {
        return $this->hasMany(Photo::class);
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


    /**
     * @return bool
     *
     * Checks if a user can access a premium quiz (and redirect him otherwise)
     */
    public function checkAccessToPremium()
    {
        // check first whether a user has premium access in the case of attempt to play a premium quiz
        if ($this->premium == 1) {
            if (auth()->user()->premium != 1) {
                session()->flash('message', 'You need to upgrade your account to premium in order to play this quiz');
                return false;
            }
            return true;
        }
    }
}
