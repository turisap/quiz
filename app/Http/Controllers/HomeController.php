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

    // search from the top of the home page via ALGOLIA engine
    public function search(Request $request)
    {
        // algolia's search
        $results = Quiz::search($request->search_terms)->get();

        foreach ($results as $result) {
            $photo = $result->photo;
            $result->photo = $photo;
        }

        $quizzes = static::getQuizzesPhoto($results);
        $chunks  = $quizzes->chunk(4);

        return view('search_results', compact('chunks'));
    }
}
