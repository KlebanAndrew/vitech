<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UserMessage extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_messages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'sender_id',
        'subject',
        'is_draft',
        'text'
    ];

    /**
     * Cast attributes
     *
     * @var array
     */
    public $casts = [
        'id'         => 'integer',
        'sender_id'  => 'integer',
        'subject'    => 'string',
        'is_draft'   => 'bool',
        'text'       => 'string',
        'updated_at' => 'string'
    ];

    /**
     * Get message sender
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     * Get message files
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function files()
    {
        return $this->hasMany(File::class, 'parent_id');
    }
    /**
     * Get receivers for message
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function receivers()
    {
        return $this->belongsToMany(
            User::class,
            'user_message',
            'message_id',
            'user_id'
        );
    }
}
