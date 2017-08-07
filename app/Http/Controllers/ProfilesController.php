<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\User;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(User $profile)
    {
        return view('profile', compact('profile'));
    }


    public function edit(User $profile)
    {
        return view('profile-edit', compact('profile'));
    }


    /**
     * @param ProfileUpdateRequest $request
     * @param User $profile
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     *
     * Updates User's profile
     */
    public function update(ProfileUpdateRequest $request, User $profile)
    {
        $profile->school  = $request->school;
        $profile->age = $request->age;
        $profile->grade = $request->grade;
        $profile->gender = $request->gender;
        $profile->favorite_subject = $request->favorite_subject;
        $profile->notes = $request->notes;


        $updated_user = $profile->save();

        if ($updated_user) {
            session()->flash('message', 'Your profile has been upgraded successfully');
            return redirect('/profile/' . $profile->id);
        }

        session()->flash('message', 'There was a problem processing your request, please try again');
        return redirect('/profile/' . $profile->id);
    }
}