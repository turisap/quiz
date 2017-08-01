<?php

namespace App\Http\Controllers;

use App\Category;
use App\Quiz;
use App\User;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        $user = User::find(2);

        $ids = $user->likeds->pluck('quiz_id');

        dd($ids);

    }
}
