<?php

namespace App\Livewire\Project;

use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ProjectsList extends Component
{
    use WithPagination;
    public $client_id;
    public $projects;

    public function mount($projects = null) : void
    {
        if($projects){
            $this->projects = $projects;

        }else{
           $this->projects = Auth::user()->currentTeam()->first()->projects()->get();
        }

    }
    public function render()
    {
        $projects = null;
        if(count($this->projects) != 0){$projects = $this->projects->toQuery()->latest()->paginate(10); }

        return view('livewire.project.projects-list',
           ['paginated_projects' =>  $projects]);
    }
}
