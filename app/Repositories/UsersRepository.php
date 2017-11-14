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
    public function getAll()
    {
        return User::all();
    }
}