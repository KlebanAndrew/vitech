<?php

namespace App;

use App\Model\UserMessage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Send messages list
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sentMessages()
    {
        return $this->hasMany(UserMessage::class, 'sender_id')-where('is_draft', 0);
    }

    /**
     * Draft messages list
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function draftMessages()
    {
        return $this->hasMany(UserMessage::class, 'sender_id')-where('is_draft', 1);
    }

    /**
     * Received messages list
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function receivedMessages()
    {
        return $this->belongsToMany(
            UserMessage::class,
            'user_message',
            'message_id',
            'user_id'
        );
    }
}
