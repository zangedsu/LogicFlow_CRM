<?php

namespace App\Livewire\Sprint;

use App\Models\Sprint;
use Livewire\Component;

class SprintShow extends Component
{
    public Sprint $sprint;

    public function getTasksProperty()
    {
//        return $this->sprint->tasks()->with('assignee')->get();
        return $this->sprint->tasks()->get();
    }

    public function getProgressProperty()
    {
        $total = $this->tasks->count();
        $done = $this->tasks->where('state', 'completed')->count();

        return $total > 0 ? round(($done / $total) * 100) : 0;
    }

    public function render()
    {
        return view('livewire.sprint.sprint-show', [
            'tasks' => $this->tasks,
            'progress' => $this->progress,
        ]);
    }
}
