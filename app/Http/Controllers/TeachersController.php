<?php

namespace App\Http\Controllers;

use App\Category;
use App\Question;
use App\Repositories\QuizRepozitory;
use App\User;
use App\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TeachersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('teacher');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('create_quiz', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Quiz $quiz, Question $question)
    {
        $data = request()->all();
        $author = auth()->user()->id;
        if (QuizRepozitory::createQuiz($data, $quiz, $question)) {
            session()->flash('message', 'Quiz were created successfully');
            return redirect('author/' . $author);
        }
        session()->flash('message', 'There was a problem processing your request, try again');
        return redirect('author/' . $author);
    }

    /**
     * Displays an author's quizzes (only for teachers).
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $author)
    {

        //first check whether the author tries to access it's own page and not another's
        if (Gate::denies('isThisAuthor', $author->id)) {
            abort(403, 'This page does not belongs to you');
        }
        $created_quizzes = $author->rightsFor->chunk(6);
        $edit = true;

        return view('my_created', compact('created_quizzes', 'edit'));
    }





    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $quiz = Quiz::find($id);

        if (Gate::denies('my_created', $quiz->author_id)) {
            abort(403, 'Sorry, you don\'t have access to that page');
        }
        $questions = $quiz->questions;
        $categories = Category::all();

        return view('quiz_edit', compact('quiz', 'questions', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $quiz = Quiz::find($id);
        dd($quiz);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
