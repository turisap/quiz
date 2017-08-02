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

    public function __construct(Liked $liked)
    {
        $this->middleware('auth')->except(['index']);
        $this->liked = $liked;
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
     * repsonds on AJAX request from like button
     */
    public function like()
    {
        $response = auth()->user()->like(request('quiz_id')) ? true : false;
        header('Content-type: application/json'); //
        echo json_encode($response);
    }


    /**
     * responds on AJAX request from unlike button
     */
    public function unlike()
    {
        $response = auth()->user()->unlike(request('quiz_id')) ? true : false;
        header('Content-type: application/json'); //
        echo json_encode($response);
    }
}
