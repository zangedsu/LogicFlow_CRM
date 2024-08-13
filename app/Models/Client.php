<?php

namespace App\Models;

use Faker\Core\Color;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Storage;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'site',
        'team_id',
        'logo_id',
    ];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
    public function projects() : HasMany
    {
        return $this->hasMany(Project::class);
    }

    public function hasActiveProjects() : bool
    {
        if($this->projects()->where('is_active', '=', true)->get()->count() != 0){return true;}
        return false;
    }

    public function logo() :HasOne
    {
        return $this->hasOne(Attachment::class, 'id', 'logo_id');
    }
}
