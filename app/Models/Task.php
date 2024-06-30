<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'deadline',
        'project_id',
        'responsible_id',
        'author_id',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function responsible(): BelongsTo
    {
        return $this->belongsTo(User::class, 'responsible_id');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function tags() : BelongsToMany
    {
        return $this->belongsToMany(TaskTag::class);
    }

    public function notes() : HasMany
    {
        return $this->hasMany(TaskNote::class);
    }

    public function state() : BelongsTo
    {
        return $this->belongsTo(TaskState::class);
    }

    protected function casts(): array
    {
        return [
            'deadline' => 'datetime',
        ];
    }
}
