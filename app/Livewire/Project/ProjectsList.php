<?php

namespace App\Livewire\Project;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ProjectsList extends Component
{
    use WithPagination;

    public $per_page;

    public $navigate_links;

    public $client_id;

    public $projects;

    public function mount($projects = null, $per_page = 10, $navigate_links = true): void
    {
        if ($projects) {
            $this->projects = $projects;

        } else {
            $this->projects = Auth::user()->currentTeam()->first()->projects()->get();
        }

        $this->per_page = $per_page;
        $this->navigate_links = $navigate_links;
    }

    public function render()
    {
        $projects = null;
        if (count($this->projects) != 0) {
            $projects = $this->projects->toQuery()->latest()->paginate($this->per_page);
        }

        return view('livewire.project.projects-list',
            ['paginated_projects' => $projects]);
    }
}
