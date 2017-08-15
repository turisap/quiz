<?php

namespace App\Http\Controllers;

use App\Liked;
use App\Quiz;
use App\Repositories\QuizRepozitory;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Repositories\QuizPhotos;

class QuizzesController extends Controller
{
    use QuizPhotos;

    protected $liked;

    public function __construct(/*Liked $liked*/)
    {
        $this->middleware('auth')->except(['index']);
        //$this->liked = $liked;
    }

    /**
     * Shows my quizzes page
     *
     * @param User $user
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     */
    public function index(User $user)
    {
        if (Gate::denies('my_quizzes', $user->id)) {
            abort(403, 'Sorry, you don\'t have access to this page');
        }

        $ids = $user->likeds->pluck('quiz_id')->toArray();
        $liked = QuizRepozitory::getAllUsersQuizzes($ids);
        $quizzes = static::getQuizzesPhoto($liked);
        $liked  = $quizzes->chunk(6);

        return view('my_quizzes', compact('liked'));
    }


    /**
     * @param Quiz $quiz
     * @return \Illuminate\Http\RedirectResponse
     *
     * Deletes a given quiz
     */
    public function delete(Quiz $quiz)
    {
        $quiz->delete();
        return back();
    }



    /**
     * repsonds on AJAX request from like button
     */
    public function like(Quiz $quiz)
    {
        $response = auth()->user()->like($quiz->id) ? true : false;
        header('Content-type: application/json'); //
        echo json_encode($response);
    }


    /**
     * responds on AJAX request from unlike button
     */
    public function unlike(Quiz $quiz)
    {
        $response = $quiz->unlike();
        header('Content-type: application/json');
        echo json_encode($response);
    }
}
