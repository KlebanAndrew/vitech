<?php

namespace App\Http\Controllers\Api;

use App\Repositories\UserMessagesRepository;
use App\Repositories\UsersRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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

    /**
     * Get users list for auth user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getContacts()
    {
        $user = Auth::user();

        $data = $this->usersRepository->getUserContactsList($user);

        return response()->json($data);
    }
}
