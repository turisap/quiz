<?php

namespace App\Http\Controllers;

use App\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Repositories\QuizPhotos;

class HomeController extends Controller
{
    use QuizPhotos;

    public function index()
    {
        $quizzes = Quiz::with('photo')->get();
        $quizzes = $quizzes->sortByDesc('views')
                           ->take(12);
        $quizzes = static::getQuizzesPhoto($quizzes);

        $chunks = $quizzes->chunk(4);

        return view('home', compact('chunks'));
    }
}
