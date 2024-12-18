<?php

namespace App\Livewire\Components;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Kanban extends Component
{
    public $tasks;

    public function updateTaskStatus($sorted): void
    {
        $states = ['new', 'in_process', 'completed', 'failed'];
        foreach ($sorted as $item) {
            foreach ($item['items'] as $id) {
                $task = Auth::user()->currentTeam()->first()->tasks()->find($id['value']);
                if ($task?->state != $item['value'] && in_array($item['value'], $states)) {
                    $task->state = $item['value'];
                    $task->save();
                }
            }
        }
        $this->updateTasks();
    }

    public function updateTasks(): void
    {
        $this->tasks = Auth::user()->currentTeam()->first()->tasks()->get();
    }

    public function render()
    {
        $this->updateTasks();

        return view('livewire.components.kanban');
    }
}
