<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quiz;

class QuestionsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param Quiz $quiz
     */
    public function play(Quiz $quiz)
    {
        $questions = $quiz->questions()->orderBy('id', 'ASC')->get();
        dd($questions);
    }
}
