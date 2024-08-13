<?php

namespace App\Livewire\Project;

use App\Actions\Project\CreateProjectAction;
use App\Models\Client;
use App\Models\Project;
use App\Models\User;
use http\Message;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use function PHPUnit\Framework\throwException;

class Create extends Component
{
    public $name;
    public $description;


    public $clients;
    public $selected_client_id;

    public function mount()
    {
       $this->clients = Client::all()->where('team_id', '=', Auth::user()->currentTeam->id);
    }

    public function render()
    {
        return view('livewire.project.create');
    }

    public function create(CreateProjectAction $createProjectAction)
    {
        $project = new Project();
        $project->name = $this->name;
        $project->description = $this->description;
        $project->client_id = $this->selected_client_id;
        $createProjectAction->create($project);
        $this->dispatch('notify', ['msg' => 'Проект '.$this->name.' был успешно создан', 'route'=> route('clients')]);
        $this->reset('name', 'description');
    }
}
