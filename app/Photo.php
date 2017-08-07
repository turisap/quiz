<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Photo extends Model
{
    protected $fillable = ['user_id', 'quiz_id', 'name', 'size'];
    protected $quarder  = ['id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function quiz()
    {
        return $this->belongsTo('App\Quiz');
    }


    public function updatePhotoRecord($file, $profile)
    {
        // file's params
        $name = $file->hashName();
        $size = $file->getSize();

        $file->storeAs('avatars', $name);


        $this->updateOrCreate(['user_id' => $profile->id], [
            'name'    => $name,
            'size'    => $size,
            'user_id' => $profile->id
        ]);
    }
}
