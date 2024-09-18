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

    public function getDurationString() : string
    {
        if($this->state == 'started'){
            $timeElapsed = $this->started_at->diffInSeconds(now()) + $this->current_duration;
        }else{
            $timeElapsed = $this->current_duration;
        }

        $hours = floor($timeElapsed / 3600);
        $minutes = floor(($timeElapsed % 3600) / 60);
        $seconds = $timeElapsed % 60;
        return $hours . ':' . $minutes . ':' . $seconds;
    }

    public function pause() : void
    {
        $timeElapsed = $this->started_at->diffInSeconds(now());
        $this->current_duration += $timeElapsed;
        $this->state = 'paused';
        $this->save();
    }

    public function continue() : void
    {
        $this->state = 'started';
        $this->started_at = now();
        $this->save();
    }

    public function stop() : void
    {
        $this->state = 'stopped';
        $this->current_duration += $this->started_at->diffInSeconds(now());
        $this->save();
    }


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
        ];
    }
}
