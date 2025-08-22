<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'deadline',
        'project_id',
        'state',
        'author_id',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function stateLogs() : HasMany
    {
        return $this->hasMany(TaskStateLog::class, 'task_id');
    }

    public function responsible_users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'task_users');
    }

    public function assignee() {
        return $this->belongsTo(User::class, 'assignee_id');
    }

    public function participants() {
        return $this->belongsToMany(User::class, 'task_user')
            ->withPivot('role')
            ->withTimestamps();
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(TaskTag::class);
    }

    public function notes(): HasMany
    {
        return $this->hasMany(TaskNote::class);
    }

    public function sprint(): HasOne
    {
        return $this->hasOne(Sprint::class);
    }

    public function timers(): HasMany
    {
        return $this->hasMany(TaskTimer::class);
    }

    protected static function booted()
    {
        static::updating(function (Task $task) {
            // Проверяем, что поле state действительно изменилось
            if ($task->isDirty('state')) {
                TaskStateLog::create([
                    'task_id' => $task->id,
                    'state' => $task->getOriginal('state'), // записываем ПРЕДЫДУЩИЙ статус
                    'status_changed_by' => auth()->id(),    // кто изменил
                ]);
                if($task->state == 'completed') {
                    $task->completed_at = now();
                    $task->completed_by = auth()->id();
                    $task->saveQuietly(); // сохраняет без вызова updating/updated
                }
            }
        });
    }

    protected function casts(): array
    {
        return [
            'deadline' => 'datetime',
        ];
    }
}
