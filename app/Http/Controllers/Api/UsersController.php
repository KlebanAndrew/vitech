<?php

namespace App\Http\Controllers\Api;

use App\Repositories\UserMessagesRepository;
use App\Repositories\UsersRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    /**
     * @var UsersRepository
     */
    protected $usersRepository;

    /**
     * UsersController constructor.
     *
     * @param UsersRepository $usersRepository
     */
    public function __construct (
        UsersRepository $usersRepository
    )
    {
        $this->usersRepository = $usersRepository;
    }

    public function getUsersList()
    {
        $data = $this->usersRepository->getAll();
    }
}
