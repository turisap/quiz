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

    public function likeds()
    {
        return $this->belongsToMany(User::class, 'likeds');
    }
}
