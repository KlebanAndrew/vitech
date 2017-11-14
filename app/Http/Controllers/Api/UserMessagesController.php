<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreUserMessageRequest;
use App\Repositories\UserMessagesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserMessagesController extends Controller
{
    /**
     * @var UserMessagesRepository
     */
    protected $userMessagesRepository;

    /**
     * UserMessagesController constructor.
     *
     * @param UserMessagesRepository $userMessagesRepository
     */
    public function __construct (
        UserMessagesRepository $userMessagesRepository
    )
    {
        $this->userMessagesRepository = $userMessagesRepository;
    }

    /**
     * @param StoreUserMessageRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreUserMessageRequest $request)
    {
        $data = $request->all();
        $user = Auth::user();

        $result = $this->userMessagesRepository->createMessage($data, $user);

        if(!$result){
            return response()->json($request->all(), 500);
        }

        return response()->json('Saved');
    }
}
