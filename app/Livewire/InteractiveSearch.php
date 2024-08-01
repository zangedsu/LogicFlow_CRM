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
    public function search()
    {
        //TODO: переделать механизм поиска
        $this->actions = SearchQuickCommands::find($this->searchText);
        $this->projects = Client::where('team_id', '=', Auth::user()->currentTeam->id)->where('name', $this->searchText)->latest()->take(10)->get();
        dd($this->projects);

    }
    public function render()
    {
        return view('livewire.interactive-search');
    }
}
