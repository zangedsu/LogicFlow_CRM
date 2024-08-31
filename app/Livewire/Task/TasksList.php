<?php

namespace App\Livewire\Task;

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
