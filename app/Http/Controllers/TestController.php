<?php

namespace App\Http\Controllers;

use PayPal\Rest\ApiContext as PayPal;

class TestController extends Controller
{
    public function index()
    {
        //$quiz = Quiz::find(request('quiz_id'));
        //dd($quiz);
        /*$quiz = Quiz::find(request('quiz_id'));
        dd($quiz->unlike() ? true : false);*/

        dd(config('paypal.redirect_url'));
    }
}
