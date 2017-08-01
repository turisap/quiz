<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Liked extends Model
{

    public $timestamps = false;

    protected $fillable = ['user_id', 'quiz_id'];

    public function likeds()
    {
        return $this->belongsToMany(User::class, 'likeds');
    }
}
