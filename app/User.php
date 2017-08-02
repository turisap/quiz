<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\App;

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

    protected $liked;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->liked = App::make('App\Liked');
    }


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
    public function ableUnlike($id)
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
    public function ableLike($quiz_id)
    {
        return ! $this->ableUnlike($quiz_id);
    }


    /**
     * @param $quiz
     *
     * Adds a given quiz to user's liked ones
     *
     * @return false|\Illuminate\Database\Eloquent\Model
     */
    public function like($quiz)
    {
        $liked = $this->liked->fill([
            'user_id'  => $this->id,
            'quiz_id'  => $quiz->id
        ]);

        return $liked->save();
    }
}

