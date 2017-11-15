<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreMessageReplyRequest;
use App\Http\Requests\StoreUserMessageRequest;
use App\Http\Requests\UploadFileRequest;
use App\Model\File;
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

    /**
     * @param StoreMessageReplyRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeReply(StoreMessageReplyRequest $request)
    {
        $data = $request->all();
        $user = Auth::user();

        $result = $this->userMessagesRepository->createMessageReply($data, $user);

        if (!$result) {
            return response()->json($request->all(), 500);
        }

        return response()->json('Saved');
    }

    /**
     * todo move to Files controller
     *
     * @param UploadFileRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadFile(UploadFileRequest $request)
    {
        $data = [
            'name' => $request->file('file')->getClientOriginalName(),
            'ext' => $request->file('file')->getClientOriginalExtension(),
        ];

        //todo move function to files repository
        $file = $this->userMessagesRepository->saveFile($data);

        $fileName = $file->token .'.'. $request->file('file')->getClientOriginalExtension();

        $request->file('file')->move(
            base_path() . '/public/assets', $fileName
        );

        return response()->json($file);
    }

    /**
     * @param $token
     */
    public function downloadFile($token)
    {
        $file = File::where('token', $token)->first();

        return \Response::download(base_path() . '/public/assets/' .$file->token . '.'.$file->ext, $file->name);
    }
    /**
     * @param $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteFile($token)
    {
        return response()->json('deleted');
    }
}
