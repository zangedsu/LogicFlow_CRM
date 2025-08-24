<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
    /**
     * Может ли пользователь просматривать задачу
     */
    public function view(User $user, Task $task): bool
    {
//        return $this->isParticipant($user, $task) || $this->isTeamMember($user, $task);
        return  $this->isTeamMember($user, $task);
    }

    /**
     * Может ли пользователь редактировать задачу
     */
    public function update(User $user, Task $task): bool
    {
        // редактировать может ответственный или участник с ролью collaborator
        if ($task->assignee_id === $user->id) {
            return true;
        }
        return $user->ownsTeam($task->project->team) || $user->hasTeamRole($task->project->client->team, 'admin');
//        return $task->participants()
//            ->where('user_id', $user->id)
//            ->wherePivot('role', 'collaborator')
//            ->exists();
    }

    /**
     * Может ли пользователь удалять задачу
     */
    public function delete(User $user, Task $task): bool
    {
        // например, только владелец команды или админ
        return $user->ownsTeam($task->project->team) || $user->hasTeamRole($task->project->client->team, 'admin');
    }

    // может ли менять статус задачи (например, выполнять)
    public function changeStatus(User $user, Task $task): bool
    {

        // ответственный всегда может менять статус
        if ($task->assignee_id === $user->id) {
            return true;
        }

        // либо если он участник с ролью collaborator
        if ($task->participants()
            ->where('users.id', $user->id)
            ->wherePivot('role', 'collaborator')
            ->exists()
        ) {
            return true;
        }

        // либо это владелец или админ
        return $user->ownsTeam($task->project->team) || $user->hasTeamRole($task->project->client->team, 'admin');

    }

    private function isParticipant(User $user, Task $task): bool
    {
        return $task->participants()->where('user_id', $user->id)->exists();
    }

    private function isTeamMember(User $user, Task $task): bool
    {
        return $user->belongsToTeam($task->project->client->team);

//        dd( \Auth::user()->ownsTeam($task->project->client->team));
//        dd( $user->belongsToTeam($task->project->client->team));
    }
}
