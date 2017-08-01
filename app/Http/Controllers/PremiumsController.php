<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PremiumsController extends Controller
{

    /**
     *  Shows pages with premiums features and PayPal checkout
     */
    public function index()
    {
        return view('premium_landing');
    }

}
