<?php

namespace App\Livewire\Sprint;

use App\Models\Project;
use App\Models\Sprint;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Form extends Component
{
    public $sprint;

    public $name;

    public $description;

    public $search_text = '';

    public $start_date;

    public $end_date;

    public $project_tasks;

    public $finded_tasks;

    public $selected_tasks;

    public $status;

    public $project_id;

    public function createOrUpdate()
    {
        $this->sprint->project_id = Auth::user()->currentTeam()->first()->projects()->find($this->project_id)->id;
        $this->sprint->name = $this->name;
        $this->sprint->description = $this->description;
        $this->sprint->start_date = $this->start_date;
        $this->sprint->end_date = $this->end_date;
        $this->sprint->status = 'active';



        $this->sprint->save();


        if(count($this->selected_tasks) > 0)
        {
            foreach ($this->selected_tasks as $selected_task)
            {
                $selected_task->sprint_id = $this->sprint->id;
                $selected_task->save();
            }
        }

        $this->reset();
        $this->dispatch('notify', ['msg' => 'Спринт сохранен']);

    }

    public function selectTask($task_id)
    {
        $task = $this->project_tasks->find($task_id);

        $this->selected_tasks->push($task);
    }

    public function mount(Sprint $sprint = new Sprint)
    {
        $this->sprint = $sprint;

        $this->name = $sprint->name;
        $this->description = $sprint->description;
        $this->start_date = $sprint->start_date;
        $this->end_date = $sprint->end_date;
        $this->status = $sprint->status;

        $this->selected_tasks = collect([]);

        if (request()->has('project')) {
            $this->project_id = request('project');
            $this->name = $sprint->name ?? 'Спринт '.Project::find($this->project_id)->name.' - '.now()->locale('RU')->monthName.', '.now()->locale('RU')->day;
        }

        $this->project_tasks = Project::find($this->project_id)->tasks->where('sprint_id', '=', null);
    }

    public function render()
    {
        //        $this->project_tasks = Project::find($this->project_id)->tasks()->where('name', 'like', '%' . $this->search_text . '%')->where('sprint_id', '=', null)->get();
        if ($this->project_tasks?->count() > 0) {
            $this->finded_tasks = $this->project_tasks?->toQuery()->where('name', 'like', '%'.$this->search_text.'%')->get();
        }
        //        dd($this->project_tasks->toQuery()->where('name', 'like', '%' . 'тест' . '%')->get());

        return view('livewire.sprint.form');
    }
}
