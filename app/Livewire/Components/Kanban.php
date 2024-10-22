<?php

namespace App\Livewire\Components;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Kanban extends Component
{

    public $tasks;

    public function updateTaskStatus($sorted) : void
    {
        $states = ['new', 'in_process', 'completed', 'failed'];
      foreach ($sorted as $item)
      {
          foreach ($item['items'] as $id){
              $task = Auth::user()->currentTeam()->first()->tasks()->find($id['value']);
              if($task?->state != $item['value'] && in_array($item['value'], $states)){
                  $task->state = $item['value'];
                  $task->save();
              }
          }
      }
      $this->updateTasks();
    }


    public function updateTasks()
    {
        $this->tasks = Auth::user()->currentTeam()->first()->tasks()->get();
    }
    public function render()
    {
    $this->updateTasks();
        return view('livewire.components.kanban');
//        return view('livewire.components.kanban',[
//            'newTasks' => Task::where('state', 'new')->get(),
//            'inProgressTasks' => Task::where('state', 'in_process')->get(),
//            'completedTasks' => Task::where('state', 'completed')->get(),
//            'failedTasks' => Task::where('state', 'failed')->get(),
//        ]);
    }
}
