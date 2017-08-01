<?php

namespace App\Http\Controllers;

use App\Repositories\QuizRepozitory;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class QuizzesController extends Controller
{
    public function index(User $user)
    {
        $ids = $user->likeds->pluck('quiz_id')->toArray();

        $liked = QuizRepozitory::getAllUsersQuizzes($ids);
        //dd($liked[0][0]);

        //$this->authorize('my_quizzes', $user->id);

        if (Gate::denies('my_quizzes', $user->id)) {
            abort(403, 'Sorry, you don\'t have access to this page');
        }

        return view('my_quizzes', compact('liked'));
    }



}
