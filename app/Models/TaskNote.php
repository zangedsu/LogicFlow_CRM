<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TaskNote extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id',
        'user_id',
        'text',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function task() : BelongsTo
    {
        return $this->belongsTo(Task::class);
    }
}
