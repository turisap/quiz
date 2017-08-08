<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TeachersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('teacher');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

        return view('my_created', compact('created_quizzes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
