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
    public function __construct(
        UserMessagesRepository $userMessagesRepository
    ) {
        $this->userMessagesRepository = $userMessagesRepository;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendList()
    {
        $user = Auth::user();

        $data = $this->userMessagesRepository->getSendList($user);

        return response()->json($data);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function inboxList()
    {
        $user = Auth::user();

        $data = $this->userMessagesRepository->getInboxList($user);

        return response()->json($data);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function draftList()
    {
        $user = Auth::user();

        $data = $this->userMessagesRepository->getDraftList($user);

        return response()->json($data);
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

        if (!$result) {
            return response()->json($request->all(), 500);
        }

        return response()->json('Saved');
    }
}
