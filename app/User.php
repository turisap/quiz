<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
     *
     * These fields are hidden from converting to JSON
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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     *
     *  Relationships with photos
     */
    public function photo()
    {
        return $this->hasMany(Photo::class);
    }



    public function rightsFor()
    {
        return $this->hasMany(Quiz::class, 'author_id');
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
    public function like($quiz_id)
    {
        $liked = $this->liked->fill([
            'user_id'  => $this->id,
            'quiz_id'  => $quiz_id
        ]);

        return $liked->save();
    }


    /**
     * @param $route_id
     * @return bool
     *
     * Checks whether a user tries to access it's own profile page and not another's
     */
    public function ownsPage($route_id)
    {
        return $this->id == $route_id;
    }


    /**
     * @param $id
     *
     * Updates user to premium after payments
     */
    public static function updateToPremium($id)
    {
        DB::table('users')->where('id', $id)
                          ->update(['premium' => 1]);

    }


    /**
     * @return bool
     *
     * Delete a record along with an old file on update
     */
    public function deleteOldPhoto()
    {
        $old_photo = $this->photo->first();

        if ($old_photo) {
            $old_photo->delete();
            Storage::delete('/avatars/' . $old_photo->name);
            return true;
        }
        return false;
    }


    /**
     * @param $route_id
     * @return bool
     *
     * Checks if a  requested page belongs to a particular author and does't another one's
     */
    public function isThisAuthor($route_id)
    {
        return $this->id == $route_id;
    }

}

