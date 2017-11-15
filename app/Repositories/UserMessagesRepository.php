<?php
/**
 * Created by PhpStorm.
 * User: andrew
 * Date: 29.07.16
 * Time: 12:21
 */

namespace App\Repositories;

use App\Model\File;
use App\Model\UserMessage;

class UserMessagesRepository
{

    /**
     * @param $user
     *
     * @return mixed
     */
    public function getSendList($user)
    {
        return $user->sentMessages()->with('sender')->paginate();
    }

    /**
     * @param $user
     *
     * @return mixed
     */
    public function getInboxList($user)
    {
        return $user->receivedMessages()->with('sender')->paginate();
    }

    /**
     * @param $user
     *
     * @return mixed
     */
    public function getDraftList($user)
    {
        return $user->draftMessages()->with('sender')->paginate();
    }

    public function createMessageReply($data, $user)
    {
        $message = UserMessage::create([
            'sender_id' => $user->id,
            'subject'   => $data['subject'],
            'text'      => $data['text']
        ]);

        if ($message) {
            $message->receivers()->sync($data['receiver']['id']);

            return true;
        }

        return false;
    }
    /**
     * @param $data
     * @param $user
     *
     * @return bool
     */
    public function createMessage($data, $user)
    {
        $message = UserMessage::create([
            'sender_id' => $user->id,
            'subject'   => $data['subject'],
            'text'      => $data['text']
        ]);

        if ($message) {
            $receivers = $this->makePivotArray($data['receivers']);
            $message->receivers()->sync($receivers);

            return true;
        }

        return false;
    }

    /**
     * Save file  todo move to Files repository
     * @param $data
     *
     * @return mixed
     */
    public function saveFile($data)
    {
        //generate token
        $token = strtolower(str_random(12));

        while (File::where('token', $token)->exists()) {
            $token = strtolower(str_random(12));
        }
        $data['token'] = $token;

        $file = File::create($data);

        return $file;
    }

    /**
     * @param $data
     *
     * @return array
     */
    protected function makePivotArray($data)
    {
        if (!is_null($data)) {

            $relationItemsIds = [];

            foreach ($data as $relationItem) {
                $relationItemsIds[] = $relationItem['id'];
            }

            $data = $relationItemsIds;
        } else {

            $data = [];
        }

        return $data;
    }
}