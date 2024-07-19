<?php

namespace App\Livewire\Widgets;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TasksTotal extends Component
{
    public $total_tasks;
    public $total_opened_tasks;
    public $total_closed_tasks;

    public function mount()
    {
        $this->total_tasks = Auth::user()->currentTeam
            ->tasks()
            ->count();

        $this->total_opened_tasks = Auth::user()->currentTeam
            ->tasks()
            ->where('state_id', '=', '1')
            ->count();
    }

    public function render()
    {
        return view('livewire.widgets.tasks-total');
    }
}
