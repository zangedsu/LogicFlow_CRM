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

    public function responsible_users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'task_users');
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


    public function sprint() : HasOne
    {
        return $this->hasOne(Sprint::class);
    }

    protected function casts(): array
    {
        return [
            'deadline' => 'datetime',
        ];
    }
}
