<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

class Sprint extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'status',
        'project_id',
    ];

    protected function progress(): Attribute
    {
        return Attribute::make(
            get: function () {
                $completed = $this->tasks()->where('state', 'completed')->count();
                $total = $this->tasks()->count();
                return $total > 0 ? round($completed / $total * 100) : 0;
            }
        );
    }

    protected function deadlineStatus(): Attribute
    {
        return Attribute::make(
            get: function () {
                $end = Carbon::parse($this->end_date);
                $now = now();

                if ($end->isPast()) {
                    return 'overdue';
                }

                if ($end->diffInDays($now) <= 3) {
                    return 'soon';
                }

                return 'ok';
            }
        );
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    protected function casts()
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
        ];
    }
}
