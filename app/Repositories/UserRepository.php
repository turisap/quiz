<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 07-Aug-17
 * Time: 8:29 AM
 */

namespace App\Repositories;


use App\User;

class UserRepository
{


    /**
     * @return \Illuminate\Support\Collection
     *
     * returns all admins in a system
     */
    public static function getAllAdmins()
    {
        return User::where('admin', 1)->get();
    }
}