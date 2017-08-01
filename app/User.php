<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Liked;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'student', 'first_name', 'last_name'
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
     * Relationships with quizzes
     *
     */

    public function likeds()
    {
        return $this->hasMany(Liked::class);
    }



    /**
     *
     * Checks whether particular quizzes are liked by a particular user
     *
     * @returns boolean
     *
     */
    public function likes($id)
    {
        return $this->id == $id;
    }



    /**
     *
     * Checks whether a user can unlike a quiz
     *
     * @returns boolean
     *
     */
    public function unlike($id)
    {
        $likeds = $this->likeds->pluck('quiz_id');

        foreach ($likeds as $liked) {
            if ($liked == $id) {
                return true;
            }
        }
        return false;
    }



    /**
     *
     * Checks whether a user can like a quiz (it shouldn't be liked before)
     *
     * @returns boolean
     *
     */
    public function like($quiz_id)
    {
        return ! $this->unlike($quiz_id);
    }
}

