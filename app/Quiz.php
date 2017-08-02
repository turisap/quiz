<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    /*
     * relationships
     */
    public function author()
    {
        return $this->belongsTo(\App\User::class);
    }

    /**
     * Relationships
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function likeds()
    {
        return $this->belongsToMany(User::class, 'likeds');
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
