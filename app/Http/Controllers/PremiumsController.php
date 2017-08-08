<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PremiumsController extends Controller
{

    public function __construct()
    {
        $this->middleware('no_premium');
        $this->middleware('auth');
    }

    /**
     *  Shows pages with premiums features and PayPal checkout
     */
    public function index()
    {
        return view('premium_landing');
    }

}
