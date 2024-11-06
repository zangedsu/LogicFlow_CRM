<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Laravel\Jetstream\Events\TeamCreated;
use Laravel\Jetstream\Events\TeamDeleted;
use Laravel\Jetstream\Events\TeamUpdated;
use Laravel\Jetstream\Team as JetstreamTeam;

class Team extends JetstreamTeam
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'personal_team',
    ];

    /**
     * The event map for the model.
     *
     * @var array<string, class-string>
     */
    protected $dispatchesEvents = [
        'created' => TeamCreated::class,
        'updated' => TeamUpdated::class,
        'deleted' => TeamDeleted::class,
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'personal_team' => 'boolean',
        ];
    }

    public function members() : BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function clients() : HasMany
    {
        return $this->hasMany(Client::class);
    }

    public function tasks() : HasManyThrough
    {
        return $this->hasManyThrough(Task::class, Client::class,
            'team_id', 'project_id', 'id', 'id');
    }

    public function sprints() : HasManyThrough
    {
        return $this->hasManyThrough(Sprint::class, Project::class
        );
    }

    public function notes() {
        return $this->through('clients')->has('projects')->with('tasks.notes');
    }


    public function projects() : HasManyThrough
    {
//        return $this->clients()->get()->projects()->all();
        return $this->hasManyThrough(Project::class, Client::class);

    }

    public function chat() : HasOne
    {
        return $this->hasOne(Chat::class);
    }


}
