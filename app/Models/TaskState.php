<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TaskState extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'is_task_active',
        'team_id',
    ];

    public function team() : BelongsTo
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function tasks() : HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function casts()
    {
        return [
            'is_task_active' => 'boolean'
        ];
    }
}
