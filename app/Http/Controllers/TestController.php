<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Support\Facades\Storage;
use PayPal\Rest\ApiContext as PayPal;

class TestController extends Controller
{
    public function index()
    {
        //$quiz = Quiz::find(request('quiz_id'));
        //dd($quiz);
        /*$quiz = Quiz::find(request('quiz_id'));
        dd($quiz->unlike() ? true : false);*/

        $photo = Photo::find(8);

        dd($photo);
        $url = Storage::disk('public')->url('avatars/' . $photo->name);

        return view('test', compact('url'));
    }
}
