<?php

namespace App\Http\Controllers;

use App\Events\UserRegistration;
use App\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class FacebookController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $facebook_user = Socialite::driver('facebook')->user();

        //dd($facebook_user->name);

        //dd($this->getNames($facebook_user->name));

        $this->findOrCreateFacebookUser($facebook_user);

        return redirect()->home();
    }



    /**
     * @param $facebook_user
     *
     * Creates or finds user based on facebook's info
     *
     * @return user model
     *
     */
    public function findOrCreateFacebookUser($facebook_user)
    {
        $user = User::firstOrNew(['email' => $facebook_user->email]);

        if ($user->exists()) {
            Auth::login($user);
        }

        $user->fill([
            'email'  => $user->email,
            'first_name' => $this->getFirstName($facebook_user->name),
            'last_name'  => $this->getLastName($facebook_user->name)
        ]);

        //dd($user);

        $user->save();

        Auth::login($user);

        event(new UserRegistration($user));

    }


    /**
     * @param $name
     *
     * gets set of first name and last name
     *
     * return array
     */
    public function getNames($name)
    {
        $name_array = explode(' ', trim($name));
        $names = [];

        foreach ($name_array as $item) {
            if ($item != '') {
                $names[] = $item;
            }
        }
        return $names;
    }


    /**
     * @param $full_name
     *
     * gets the first name of a fb user
     *
     * @return mixed
     */
    public function getFirstName($full_name)
    {
        $array = $this->getNames($full_name);
        return array_shift($array);
    }


    /**
     * @param $full_name
     *
     * gets the last name of a fb user
     *
     * @return mixed
     */
    public function getLastName($full_name)
    {
        $array = $this->getNames($full_name);
        return array_pop($array);
    }
}
