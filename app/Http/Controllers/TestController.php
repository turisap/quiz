<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Support\Facades\Storage;
use PayPal\Rest\ApiContext as PayPal;
use App\User;

class TestController extends Controller
{
    public function index()
    {
        /*$photo = Photo::find(8);

        dd($photo);
        $url = Storage::disk('public')->url('avatars/' . $photo->name);

        return view('test', compact('url'));*/

        return view('baseviews.404');

    }
}
