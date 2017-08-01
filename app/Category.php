<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    public function courses()
    {
        return $this->belongsToMany(\App\Course::class);
    }

    /*
     * set param for route model binding
     */
    public function getRouteKeyName()
    {
        return 'name';
    }


    /*
     * gets array of all categories
     * @return array
     */
    public static function categories()
    {
        $categories = Category::pluck('id', 'name')->toArray();

        return $categories;
    }

}
