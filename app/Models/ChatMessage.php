<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChatMessage extends Model
{
    protected $fillable = [
        'sender_id',
        'chat_id',
        //        'recipient_id',
        'message',
    ];

    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function reads()
    {
        return $this->belongsToMany(User::class, 'message_reads')->withTimestamps();
    }

    public function chat(): BelongsTo
    {
        return $this->belongsTo(Chat::class);
    }

    //    public function recipient(): BelongsTo
    //    {
    //        return $this->belongsTo(User::class, 'recipient_id');
    //    }
}
