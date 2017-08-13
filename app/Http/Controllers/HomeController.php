<?php

namespace App\Http\Controllers;

use App\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::with('photo')->get();
        $quizzes = $quizzes->sortByDesc('views')
                           ->take(12);
        foreach ($quizzes as $quiz) {
            if ($quiz->photo) {
                $quiz->url = Storage::disk('public')->url('quizzes/' . $quiz->photo->name);
            }
        }

        $chunks = $quizzes->chunk(4);

        return view('home', compact('chunks'));
    }
}
