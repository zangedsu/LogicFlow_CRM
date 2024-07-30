<?php

namespace App\Livewire\Client;

use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ClientsList extends Component
{
    use WithPagination;
    //!!! ВОЗМОЖНО лайвайр ругается, так как в публичных свойствах класса нельзя хранить объект, который получается на выходе после paginate
#[On('clients-list-updated')]
    public function update()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.client.clients-list',
            ['paginated_clients' => Client::where('team_id', '=', Auth::user()->currentTeam->id)
                ->latest()
                ->paginate(10)
            ]);
    }
}
