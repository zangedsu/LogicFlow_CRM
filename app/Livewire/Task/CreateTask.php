<?php

namespace App\Livewire\Task;

use App\Models\Task;
use App\Notifications\TaskAssignedNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateTask extends Component
{
    public Task $task;

    #[Validate ('required', message: 'Введите название задачи')]
    public $name;

    public $description;

    public $deadline;

    public $team_users;

    public $projects;

    #[Validate ('required', message: 'Обязательно нужно указать проект')]
    public $selected_project_id;

    public $responsible_users = [];

    public $responsible;

    public $is_edit = false;

    public function add_responsible()
    {

        if ($this->responsible == 'all_team') {
            $this->responsible_users = $this->team_users;
        } else {
            $this->responsible_users[] = $this->team_users->find($this->responsible);
        }
        $this->team_users = $this->team_users->diff($this->responsible_users);

        $this->reset('responsible');
    }

    public function resetResponsible()
    {
        $this->responsible_users = [];
        $this->team_users = Auth::user()->currentTeam()->first()->members;
    }

    public function create()
    {
        $this->validate();
        $this->task->name = $this->name;
        $this->task->description = $this->description;
        $this->task->deadline = Carbon::createFromFormat('Y-m-d\TH:i', $this->deadline);
        $this->task->project_id = $this->selected_project_id;
        $this->task->author_id = Auth::user()->id;

        $this->task->save();
        //dd($this->task->id);

        if ($this->responsible_users) {
            $task = Task::find($this->task->id);
            foreach ($this->responsible_users as $user) {
                $task->responsible_users()->attach($user);
                $user->notify(new TaskAssignedNotification($task));
            }
        }

        $this->dispatch('notify', ['msg' => 'Задача была сохранена']);
        $this->reset('name', 'description', 'deadline');
    }

    public function mount(Task $task = new Task)
    {
        $this->projects = Auth::user()->currentTeam()->first()->projects;

        if (request('project') and $this->projects->contains('id', request('project'))) {
            $this->selected_project_id = request('project');
        }

        $this->responsible_users = null;

        $this->task = $task;
        $this->name = $task->name;
        $this->description = $task->description;
        $this->deadline = Carbon::parse($task->deadline)->format('Y-m-d\TH:i');
        $this->team_users = Auth::user()->currentTeam()->first()->members;
        $this->selected_project_id = $task->project?->id;
    }

    public function render()
    {
        return view('livewire.task.create-task');
    }
}
