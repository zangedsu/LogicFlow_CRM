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
    public $start_date;
    public $end_date;

    public $project_tasks;
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
    }


    public function mount(Sprint $sprint = new Sprint())
    {
        $this->sprint = $sprint;

        $this->name = $sprint->name;
        $this->description = $sprint->description;
        $this->start_date = $sprint->start_date;
        $this->end_date = $sprint->end_date;
        $this->status = $sprint->status;


        if(request()->has('project')){
            $this->project_id = request('project');
            $this->name = $sprint->name ?? 'Спринт ' . Project::find($this->project_id)->name . ' - ' . now()->locale('RU')->monthName. ', ' . now()->locale('RU')->day;
        }

        $this->project_tasks = Project::find($this->project_id)->tasks->where('sprint_id', '=', null);

    }

    public function render()
    {
        return view('livewire.sprint.form');
    }
}
