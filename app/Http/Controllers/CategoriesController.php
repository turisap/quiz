<?php

namespace App\Http\Controllers;

use App\Category;
use App\Quiz;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;


class CategoriesController extends Controller
{

    // category page
    public function index(Category $category)
    {
        $data = CategoryRepository::getInfoForIndexPage($category);

        $main_quiz = $data['quiz'] ?? null;
        $quizzes   = $data['quizzes'] ?? null;

        //dd($quizzes);

        return view('category', compact('category', 'main_quiz', 'quizzes'));
    }
}
