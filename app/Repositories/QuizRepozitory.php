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


    public function createQuiz(array $data)
    {
        $questions = array_key_exists('question', $data) ?? null;
        $answer1   = array_key_exists('answer1', $data)  ?? null;
        $answer2   = array_key_exists('answer2', $data)  ?? null;
        $answer3   = array_key_exists('answer3', $data)  ?? null;
        $answer4   = array_key_exists('answer4', $data)  ?? null;

        //$right_answer = array_key_exists('')
    }
}