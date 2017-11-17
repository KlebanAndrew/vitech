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
        return $user->sentMessages()->with('sender', 'files', 'receivers')->paginate(100);
    }

    /**
     * @param $user
     *
     * @return mixed
     */
    public function getInboxList($user)
    {
        return $user->receivedMessages()->with('sender', 'files')->paginate(100);
    }

    /**
     * @param $user
     *
     * @return mixed
     */
    public function getDraftList($user)
    {
        return $user->draftMessages()->with('sender', 'files', 'receivers')->paginate(100);
    }

    /**
     * Get draft by id todo refactor
     *
     * @param $id
     *
     * @return mixed
     */
    public function getDraft($id)
    {
        return UserMessage::where('id', $id)->with('receivers', 'files')->first();
    }

    /**
     * Create message reply
     *
     * @param $data
     * @param $user
     *
     * @return bool
     */
    public function createMessageReply($data, $user)
    {
        $message = UserMessage::create([
            'sender_id' => $user->id,
            'subject'   => $data['subject'],
            'text'      => $data['text']
        ]);

        if ($message) {
            if (array_get($data, 'files')) {
                $this->setFile($message->id, $data['files'][0]['id']);
            }

            $message->receivers()->sync($data['receiver']['id']);

            return true;
        }

        return false;
    }

    /**
     * Save draft
     *
     * @param $data
     * @param $user
     *
     * @return bool
     */
    public function createMessageDraft($data, $user)
    {
        $data['sender_id'] = $user->id;
        $data['is_draft'] = 1;

        $message = UserMessage::create($data);

        if ($message) {
            if (array_get($data, 'files')) {
                $this->setFile($message->id, $data['files'][0]['id']);
            }

            if(array_get($data, 'receivers')){
                $receivers = $this->makePivotArray($data['receivers']);
                $message->receivers()->sync($receivers);
            }

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
            if (array_get($data, 'files')) {
                $this->setFile($message->id, $data['files'][0]['id']);
            }

            $receivers = $this->makePivotArray($data['receivers']);
            $message->receivers()->sync($receivers);

            return true;
        }

        return false;
    }

    /**
     * Save file  todo move to Files repository
     *
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
     * @param $messageId
     * @param $fileId
     */
    protected function setFile($messageId, $fileId)
    {
        $file = File::where('id', $fileId);
        $file->update(['parent_id' => $messageId]);
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