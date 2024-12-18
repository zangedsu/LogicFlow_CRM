<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'is_active',
        'client_id',
    ];

    public function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function hasActiveTasks(): bool
    {
        if ($this->tasks()->where('state', '!=', 'failed')->where('state', '!=', 'completed')->get()->count() != 0) {
            return true;
        }

        return false;
    }

    public function taskNotes(): HasManyThrough
    {
        return $this->hasManyThrough(TaskNote::class, Task::class, 'project_id', 'task_id');
    }

    public function timers(): HasManyThrough
    {
        return $this->hasManyThrough(TaskTimer::class, Task::class);
    }

    public function sprints(): HasMany
    {
        return $this->hasMany(Sprint::class);
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(Attachment::class);
    }
}
