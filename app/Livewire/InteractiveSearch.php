<?php

namespace App\Livewire;

use App\Classes\SearchQuickCommands;
use App\Models\Client;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class InteractiveSearch extends Component
{
    public $searchText ='';
    public $isOpened = false;
    public $actions;
    public $projects;
    public $tasks;
    public $teams;
    public $clients;
    public $sprints;


    public function updated($property)
    {
        if($property === 'searchText')
        {
            $this->search();
        }
    }

    public function clickToHint($hint_text) : void
    {
        $this->searchText = $hint_text;
    }

    public function search() : void
    {
        $this->actions = SearchQuickCommands::find($this->searchText);

        if($this->searchText !=''){

            $this->clients = Client::where('team_id', '=', Auth::user()->currentTeam->id)
                ->where('name','like', '%'.$this->searchText.'%')
                ->latest()->take(10)
                ->get();

            $this->projects = Auth::user()->currentTeam->projects()
                ->where('projects.name', 'like', '%' . $this->searchText . '%')
                ->latest()
                ->take(10)
                ->get();

            $this->tasks = Auth::user()->currentTeam->tasks()
                ->where('tasks.name', 'like', '%' . $this->searchText . '%')
                ->latest()
                ->take(10)
                ->get();

        }else{
            $this->clients = null;
            $this->projects = null;
            $this->tasks = null;
        }

    }

    public function render()
    {
//        $this->clients = Client::where('team_id', '=', Auth::user()->currentTeam->id)->where('name','like', '%'.$this->searchText.'%')->latest()->take(10)->get();
        $this->search();
        return view('livewire.interactive-search');
    }
}
