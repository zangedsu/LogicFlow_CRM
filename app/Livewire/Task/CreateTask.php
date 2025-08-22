<?php

namespace App\Livewire\Task;

use App\Models\Task;
use App\Models\Team;
use App\Notifications\TaskAssignedNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateTask extends Component
{
    public Task $task;

    #[Validate('required', message: 'Введите название задачи')]
    public $name;

    public $description;
    public $deadline;
    public $projects;

    #[Validate('required', message: 'Обязательно нужно указать проект')]
    public $selected_project_id;

    #[Validate('required', message: 'Нужно выбрать исполнителя')]
    public $assignee_id; // один ответственный

    public $participants = []; // массив id участников

    public $team_users;
    public $is_edit = false;

    public $searchParticipant = '';

    public function create()
    {
        $this->validate();

        $this->task->name        = $this->name;
        $this->task->description = $this->description;
        $this->task->deadline    = $this->deadline
            ? Carbon::createFromFormat('Y-m-d\TH:i', $this->deadline)
            : null;
        $this->task->project_id  = $this->selected_project_id;
        $this->task->author_id   = Auth::id();
        $this->task->assignee_id = $this->assignee_id;

        $this->task->save();

        // прикрепляем участников с ролями
        if (!empty($this->participants)) {
            $syncData = [];
            foreach ($this->participants as $userId => $role) {
                $syncData[$userId] = ['role' => $role];
            }
            $this->task->participants()->sync($syncData);
        } else {
            $this->task->participants()->sync([]);
        }

        // уведомляем назначенного исполнителя
        $this->task->assignee?->notify(new TaskAssignedNotification($this->task));

        $this->dispatch('notify', ['msg' => 'Задача была сохранена']);
        $this->reset('name', 'description', 'deadline', 'assignee_id', 'participants');
    }


    public function mount(Task $task = new Task)
    {
        $team = Auth::user()->currentTeam()->first();

        $this->projects   = $team?->projects ?? collect();
        $this->team_users = $team?->members ?? collect();

        $this->task       = $task;
        $this->name       = $task->name;
        $this->description= $task->description;
        $this->deadline   = $task->deadline
            ? Carbon::parse($task->deadline)->format('Y-m-d\TH:i')
            : null;
        $this->selected_project_id = $task->project?->id;
        $this->assignee_id = $task->assignee_id;

        // участники + их роли
        $this->participants = $task->participants()
            ->withPivot('role')
            ->get()
            ->mapWithKeys(fn($user) => [$user->id => $user->pivot->role])
            ->toArray();
    }


    /**
     * Установить ответственного
     */
    public function setResponsible(int $userId): void
    {
        $this->assignee_id = $userId;
    }

    /**
     * Добавить/убрать участника
     */
    public function toggleParticipant(int $userId): void
    {
        if (isset($this->participants[$userId])) {
            unset($this->participants[$userId]);
        } else {
            $this->participants[$userId] = 'collaborator'; // роль по умолчанию
        }
    }

    /**
     * Обновить роль участника
     */
    public function updateRole(int $userId, string $role): void
    {
        if (isset($this->participants[$userId])) {
            $this->participants[$userId] = $role;
        }
    }

    public function render()
    {
//        $team = Auth::user()->currentTeam()->first();
//        $this->team_users = $team?->members->toQuery()->where('name', 'like', '%'.$this->searchParticipant.'%')->get() ?? collect();
        return view('livewire.task.create-task');
    }
}
