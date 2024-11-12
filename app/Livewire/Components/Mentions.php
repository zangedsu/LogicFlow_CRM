<?php

namespace App\Livewire\Components;

use Livewire\Component;

class Mentions extends Component
{
    public $mentions_list;

    public function render()
    {
        return view('livewire.components.mentions');
    }
}
