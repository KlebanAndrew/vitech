<?php
/**
 * Created by PhpStorm.
 * User: andrew
 * Date: 29.07.16
 * Time: 12:21
 */

namespace App\Repositories;

use App\User;

class UsersRepository
{
    /**
     * Get list of users except Auth user
     *
     * @param $user
     *
     * @return mixed
     */
    public function getUserContactsList($user)
    {
        return User::where('id', '<>', $user->id)->get();
    }
}