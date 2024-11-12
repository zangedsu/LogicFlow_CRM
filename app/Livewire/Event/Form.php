<?php

namespace App\Livewire\Event;

use Livewire\Component;

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

    }

    public function render()
    {
        return view('livewire.event.form');
    }
}
