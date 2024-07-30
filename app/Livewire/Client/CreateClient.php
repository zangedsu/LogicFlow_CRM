<?php

namespace App\Livewire\Client;

use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Laravel\Jetstream\InteractsWithBanner;

class CreateClient extends Component
{
    use InteractsWithBanner;
    #[Validate('required', message: 'Это обязательное поле')]
    #[Validate('min:3', message: 'Название клиента должно быть длиннее 3 символов')]
    public $name;
    #[Validate('min:6', message: 'Номер телефона должен быть длиннее 6 символов')]
    #[Validate('max:12', message: 'Номер телефона должен быть короче 12 символов')]
    public $phone;
    #[Validate('url', message: 'Введите корректный URL (https://google.com)')]
    public $site;
    public function create() : void
    {
        $this->validate();
        Client::create(['name'=>$this->name, 'phone' => $this->phone, 'site' => $this->site,
            'team_id' => Auth::user()->currentTeam->id]);
        $this->reset();
        $this->dispatch('clients-list-updated', ['msg' => 'Клиент добавлен']);
    }

    public function render()
    {
        return view('livewire.client.create-client');
    }
}
