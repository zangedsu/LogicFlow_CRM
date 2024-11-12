<?php

namespace App\Livewire\Project;

use App\Models\Client;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Create extends Component
{
    public $name;

    public $description;

    public $project;

    public $is_edit = false;

    public $clients;

    public $selected_client_id;

    public function mount(Project $project = new Project)
    {
        $this->project = $project;
        $this->clients = Client::all()->where('team_id', '=', Auth::user()->currentTeam->id);
        if (request('client') and $this->clients->contains('id', request('client'))) {
            $this->selected_client_id = request('client');
        }

        if ($project->name) {
            $this->is_edit = true;

            $this->name = $project->name;
            $this->description = $project->description;
            $this->selected_client_id = $project->client_id;
        }

    }

    public function render()
    {
        return view('livewire.project.create');
    }

    public function create()
    {
        $this->project->name = $this->name;
        $this->project->description = $this->description;
        $this->project->client_id = $this->selected_client_id;
        if ($this->is_edit) {
            $this->project->update();
            $this->dispatch('notify', ['msg' => 'Проект '.$this->name.' был успешно обновлен', 'route' => route('clients')]);
        } else {
            $this->project->save();
            $this->reset('name', 'description');
            $this->dispatch('notify', ['msg' => 'Проект '.$this->name.' был успешно создан', 'route' => route('clients')]);
        }

    }
}
