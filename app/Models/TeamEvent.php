<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TeamEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'date_time',
        'author_id',
        'team_id',
        'link',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    protected function casts()
    {
        return [
            'date_time' => 'datetime',
        ];
    }
}
