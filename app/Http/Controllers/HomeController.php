<?php

namespace App\Http\Controllers;

use App\Quiz;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::all()
            ->sortByDesc('views')
            ->take(12);


        $chunks = $quizzes->chunk(6);

        //dd($chunks);

        return view('home', compact('chunks'));
    }
}
