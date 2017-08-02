<?php

namespace App\Http\Controllers;

use App\Category;
use App\Mail\NewUser;
use App\Quiz;
use App\User;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        //$quiz = Quiz::find(request('quiz_id'));
        //dd($quiz);
        /*$quiz = Quiz::find(request('quiz_id'));
        dd($quiz->unlike() ? true : false);*/
    }
}
