<?php

namespace App\Http\Controllers;

use App\Liked;
use App\Quiz;
use App\Repositories\QuizRepozitory;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class QuizzesController extends Controller
{

    protected $liked;
    protected $user;

    public function __construct(Liked $liked)
    {
        $this->middleware('auth')->except(['index']);
        $this->liked = $liked;
        $this->user = auth()->user();
    }



    public function index(User $user)
    {
        $ids = $user->likeds->pluck('quiz_id')->toArray();

        $liked = QuizRepozitory::getAllUsersQuizzes($ids);

        if (Gate::denies('my_quizzes', $user->id)) {
            abort(403, 'Sorry, you don\'t have access to this page');
        }

        return view('my_quizzes', compact('liked'));
    }


    /**
     * @param Quiz $quiz
     */
    public function like(Quiz $quiz)
    {
        return $this->user->like($quiz) ? true : false;
    }



}
