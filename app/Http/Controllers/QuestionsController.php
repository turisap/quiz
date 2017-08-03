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
     *
     * Serves respective view with the first question
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function play(Quiz $quiz)
    {
        $questions = $quiz
            ->questions()
            ->orderBy('id', 'ASC')
            ->get()
            ->toArray();

        $current_question = request('question') ?? 0;
        $question = array_shift($questions);
        $question_json = json_encode($question, JSON_PRETTY_PRINT);

        return view('quiz', compact(['quiz', 'current_question', 'question', 'questions', 'question_json']));
    }


    /**
     * @param Quiz $quiz
     *
     * For ajax requests from the play quiz page
     *
     * @return string
     */
    public function getAjax(Quiz $quiz)
    {
        $current_question = request('question') ?? 0;

        if ($current_question < count($quiz->questions->toArray())) {
            $question = $quiz->questions[$current_question];
            $question->currentQuestion = $current_question;

            return json_encode($question, JSON_PRETTY_PRINT);
        }
        return json_encode(false);
    }
}
