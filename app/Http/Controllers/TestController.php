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
        /*$user = User::first();
        $mail = new NewUser($user);
        dd($mail->url);*/
        dd(config('mail.urlStub'));
    }
}
