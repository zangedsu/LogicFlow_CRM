<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TaskTimer extends Model
{
    use HasFactory;

    protected $fillable = [
        'started_at',
        'current_duration',
        'state',
        'task_id',
        'user_id',
        'team_id',
    ];

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    protected function casts()
    {
        return [
            'started_at' => 'datetime',
            'current_duration' => 'datetime',
        ];
    }
}
