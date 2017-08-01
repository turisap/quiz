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

      return redirect()->home();
    }
}
