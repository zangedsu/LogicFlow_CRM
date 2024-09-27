<?php

namespace App\Livewire\Task;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class TasksList extends Component
{

    use WithPagination;
    public $per_page;
    public $navigate_links;
    public $project_id;
    public $tasks;
    public $states = ['new'=>'Новая', 'in_process'=>'В работе', 'completed'=>'Завершена', 'failed'=>'Не удалась'];

    public function changeTaskState($task_id, $state)
    {
//        $states = ['new', 'in_process', 'completed', 'failed'];
        $task = Task::find($task_id);

        if($task && array_key_exists($state, $this->states)){
            $task->state = $state;
            $task->save();
        } else {abort(403);}
    }
    public function mount($tasks = null, $per_page = 10, $navigate_links = true) : void
    {
        if($tasks){
            $this->$tasks = $tasks;
        }else{
            $this->tasks = Auth::user()->currentTeam()->first()->tasks()->get();

        }

        $this->per_page = $per_page;
        $this->navigate_links = $navigate_links;

    }


    public function render()
    {

        $tasks = null;
        if(count($this->tasks) != 0){$tasks = $this->tasks->toQuery()->latest()->paginate($this->per_page); }
        return view('livewire.task.tasks-list', ['paginated_tasks' => $tasks]);
    }
}
