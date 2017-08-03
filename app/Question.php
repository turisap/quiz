<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{


    public $timestamps = false;
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function quiz()
    {
        return $this->belongsTo('App\Quiz');
    }
}
