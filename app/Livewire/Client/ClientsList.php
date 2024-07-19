<?php

namespace App\Livewire\Client;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class ClientsList extends Component
{
    public $clients;

    public function mount()
    {
        $this->clients = Auth::user()->currentTeam->clients;
    }

#[On('clients-list-updated')]
    public function update()
    {
    $this->clients = Auth::user()->currentTeam->clients;
    }

    public function render()
    {
        return view('livewire.client.clients-list');
    }
}
