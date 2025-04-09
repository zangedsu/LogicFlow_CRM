<?php

namespace App\Livewire\Event;

use App\Models\TeamEvent;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Toaster;

class Form extends Component
{
    public $name;
    public $description;
    public $date_time;
    public $author_id;
    public $tagged_users;
    public $link;

    public function save() : void
    {
        TeamEvent::create([
            'name' => $this->name,
            'description' => $this->description,
            'date_time' => $this->date_time,
            'author_id' => Auth::id(),
            'link' => $this->link,
            'team_id' => Auth::user()->currentTeam()->first()->id,
        ]);
        Toaster::success('!!');
    }

    public function render()
    {
        return view('livewire.event.form');
    }
}
