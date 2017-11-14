<?php
/**
 * Created by PhpStorm.
 * User: andrew
 * Date: 29.07.16
 * Time: 12:21
 */

namespace App\Repositories;

use App\Model\UserMessage;

class UserMessagesRepository
{
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
            'subject' => $data['subject'],
            'text' => $data['text']
        ]);

        if($message){
            $receivers = $this->makePivotArray($data['receivers']);
            $message->receivers()->sync($receivers);

            return true;
        }

        return false;
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