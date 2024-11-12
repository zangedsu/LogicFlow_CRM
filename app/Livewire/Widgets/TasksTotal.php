<?php

namespace App\Livewire\Widgets;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TasksTotal extends Component
{
    public $total_tasks;

    public $total_new_tasks;

    public $total_completed_tasks;

    public $rate;

    public function mount()
    {
        $this->total_tasks = Auth::user()->currentTeam
            ->tasks()
            ->count();

        $this->total_new_tasks = Auth::user()->currentTeam
            ->tasks()
            ->where('state', '=', 'new')
            ->count();

        $this->total_completed_tasks = Auth::user()->currentTeam
            ->tasks()
            ->where('state', '=', 'completed')
            ->count();

        if ($this->total_completed_tasks && $this->total_new_tasks) {
            $this->rate = round(($this->total_completed_tasks / $this->total_new_tasks) * 100);
        }

    }

    public function placeholder()
    {
        return view('components.sceleton');
    }

    public function render()
    {
        return view('livewire.widgets.tasks-total');
    }
}
