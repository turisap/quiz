<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 30-Jul-17
 * Time: 10:00 AM
 */

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Quiz;
use Illuminate\Support\Facades\Storage;
use App\Repositories\QuizPhotos;

class CategoryRepository
{

    use QuizPhotos;

    public static function getInfoForIndexPage($category)
    {
        $max_views = DB::table('quizzes')
            ->where('category_id', $category->id)
            ->max('views');
        $main_quiz = Quiz::with('author')
            ->where('views', $max_views)
            ->where('category_id', $category->id)
            ->first();
        $quizzes = Quiz::where('category_id', $category->id)
            ->get();
        $quizzes = $quizzes->sortByDesc('views');

        $quizzes = static::getQuizzesPhoto($quizzes);
        if ($main_quiz->photo) {
            $main_quiz->url = Storage::disk('public')->url('quizzes/' . $main_quiz->photo->name);
        }
        $quizzes = $quizzes->chunk(4);

        return [
            'quiz' => $main_quiz,
            'quizzes' => $quizzes
        ];
    }



}