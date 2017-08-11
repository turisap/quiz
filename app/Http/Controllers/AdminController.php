<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AdminController extends Controller
{


    public function __construct()
    {
        $this->middleware('admin');
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * shows admin page with all users
     */
    public function index()
    {
        $users = User::with('rightsFor')->paginate(5);
        return view('admin_home', compact('users'));
    }

    /**
     * @param User $user
     *
     * returns response to AJAX request
     */
    public function grantTeacherStatus(User $user)
    {
        $user->teacher = 1;
        $user->student = 0;
        $response = $user->save();
        header('Content-type: application/json');
        echo json_encode($response);
    }


    /**
     * @param User $user
     *
     * returns response to AJAX request
     */
    public function grantAdminStatus(User $user)
    {
        $user->admin = 1;
        $user->student = 0;
        $user->teacher = 0;
        $response = $user->save();
        header('Content-type: application/json');
        echo json_encode($response);
    }

    public function deleteUser(User $user)
    {
        $response = $user->delete();
        header('Content-type: application/json');
        echo json_encode($response);
    }
}
