<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Photo;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(User $profile)
    {
        $photo = $profile->photo->first();

        $url = Storage::disk('public')->url('avatars/' . $photo->name);

        return view('profile', compact('profile', 'url'));
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
    public function update(ProfileUpdateRequest $request, User $profile, Photo $photo)
    {
        $profile->school  = $request->school;
        $profile->age = $request->age;
        $profile->grade = $request->grade;
        $profile->gender = $request->gender;
        $profile->favorite_subject = $request->favorite_subject;
        $profile->notes = $request->notes;

        $file = $request->file('profile_picture');
        //dd($file);

        if ($file) {
            // file's params
            $name = $file->hashName();
            $size = $file->getSize();

            // delete the old photo if there is one
            $old_photo = $profile->photo->first();
            //dd($old_photo->name);
            if ($old_photo) {
                $photo->delete();
                Storage::delete('/avatars/' . $old_photo->name);
            }

            $file->storeAs('avatars', $name);


            $photo->updateOrCreate(['user_id' => $profile->id], [
                'name'    => $name,
                'size'    => $size,
                'user_id' => $profile->id
            ]);
        }


        $updated_user = $profile->save();

        if ($updated_user) {
            session()->flash('message', 'Your profile has been upgraded successfully');
            return redirect('/profile/' . $profile->id);
        }

        session()->flash('message', 'There was a problem processing your request, please try again');
        return redirect('/profile/' . $profile->id);
    }
}
