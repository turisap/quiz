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
        $questions = $quiz
            ->questions()
            ->orderBy('id', 'ASC')
            ->get()
            ->toArray();

        //dd($questions);

        $current_question = request('question') ?? 1;
        $question = $questions[$current_question];
        $json = json_encode($question, JSON_PRETTY_PRINT);
        //dd($json);

        return view('quiz', compact(['quiz', 'current_question', 'question', 'questions', 'json']));
    }
}
