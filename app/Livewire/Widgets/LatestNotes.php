<?php

namespace App\Livewire\Widgets;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LatestNotes extends Component
{
    public $notes;

    public function getFormattedTime($datetime)
    {
        return Carbon::parse($datetime)->locale('ru')->diffForHumans();
    }

    public function mount()
    {
        $this->notes = collect([]);
        $tasks = Auth::user()->currentTeam()->first()->tasks()->get();

        foreach ($tasks as $task) {
            if ($task->notes()?->count() > 0) {
                foreach ($task->notes()->get() as $note) {
                    $this->notes->push($note);
                }
            }
        }

    }

    public function render()
    {
        $this->notes = $this->notes->sortByDesc('created_at');

        return view('livewire.widgets.latest-notes');
    }
}
