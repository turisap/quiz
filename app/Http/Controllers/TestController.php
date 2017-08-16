<?php

namespace App\Http\Controllers;

use App\Photo;
use App\Quiz;
use Illuminate\Support\Facades\Storage;
use PayPal\Rest\ApiContext as PayPal;
use App\User;
use Faker\Generator as Faker;

class TestController extends Controller
{
    public function index(Faker $faker)
    {
        $quizzes = Quiz::all();

        foreach ($quizzes as $quiz) {
            $author_id = $faker->biasedNumberBetween(2, 7);
            $quiz->author_id = $author_id;
            $quiz->save();
        }


    }
}
