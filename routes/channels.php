<?php

use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('user.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('team.{team_id}', function (User $user, $team_id) {
    //    return (int) 1 === (int) $team_id;
    return (bool)Team::find((int)$team_id)->users()->where('id', $user->id);
});
