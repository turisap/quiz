<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 30-Jul-17
 * Time: 7:10 PM
 */

namespace App\Repositories;

use App\Quiz;

class QuizRepozitory
{


    public static function getAllUsersQuizzes($ids)
    {
        $liked = [];
        if (!empty($ids)) {
            foreach ($ids as $id) {
                $user = Quiz::find($id);
                $liked[] = $user;
            }
        }

        return collect($liked)->chunk(6);
    }
}