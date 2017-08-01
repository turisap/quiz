<?php

namespace App\Http\Controllers;

use App\Events\UserRegistration;
use App\Http\Requests\SignUpUserREquest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Support\Facades\Auth;

class AuthorizationController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest')->except(['logout']);
    }

    /*
     * shows login page
     */
    public function index()
    {
        return view('login');
    }

    /*
     * shows signup page
     */
    public function show()
    {
        return view('signup');
    }

    /*
     * creates a user
     */
    public function create(SignUpUserREquest $request, User $user)
    {
        $user->fill([
            'email' => request('email'),
            'last_name' => request('last_name'),
            'first_name' => request('first_name'),
            'password'   => Hash::make(request('password'))
        ])
        ->save();

        //dd($user);

        if ($user) {
            auth()->login($user);
            session()->flash('message', 'You\'ve been successfully signed up');
            event(new UserRegistration($user));
            return redirect()->route('home');
        }

        session()->flash('message', 'There was a problem processing your request, try again');
        return redirect()->route('home');
    }



    /*
     * logins user in
     */

    public function login()
    {
        $user = Auth::attempt([
            'email'    => request('email'),
            'password' => request('password')
        ]);

        if ($user) {
            session()->flash('message', 'You\'ve been successfully logged in');
            return redirect()->route('home');
        }

        session()->flash('message', 'Wrong combination of email and password');
        return redirect()->back();
    }

    public function logout()
    {
        auth()->logout();
        session()->flash('message', 'You\'ve been logged out');
        return redirect()->route('home');
    }
}
