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

class CategoryRepository
{

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
            ->get()
            ->chunk(6);

        return [
            'quiz' => $main_quiz,
            'quizzes' => $quizzes
        ];
    }



}