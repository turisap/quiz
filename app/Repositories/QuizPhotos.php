<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 13-Aug-17
 * Time: 8:26 PM
 */

namespace App\Repositories;

use Illuminate\Support\Facades\Storage;

trait QuizPhotos
{
    // join photo url to each quiz object
    public static function getQuizzesPhoto($quizzes)
    {
        foreach ($quizzes as $quiz) {
            if ($quiz->photo) {
                $quiz->url = Storage::disk('public')->url('quizzes/' . $quiz->photo->name);
            }
        }
        return $quizzes;
    }
}