<?php

namespace App\Livewire\Client;

use App\Models\Attachment;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\WithFileUploads;

class CreateClient extends Component
{
    use WithFileUploads;
    use InteractsWithBanner;
    public $client;
    public $is_edit = false;
    #[Validate('required', message: 'Это обязательное поле')]
    #[Validate('min:3', message: 'Название клиента должно быть длиннее 3 символов')]
    public $name;
    #[Validate('min:6', message: 'Номер телефона должен быть длиннее 6 символов')]
    #[Validate('max:16', message: 'Номер телефона должен быть короче 12 символов')]
    public $phone;
    #[Validate('url', message: 'Введите корректный URL (https://google.com)')]
    public $site;

    #[Validate('email', message: 'Введите корректный адрес Email')]
    public $email;

    #[Validate('image', message: 'Выберите изображение (JPEG, PNG, GIF')]
    #[Validate('max:1024', message: 'Максимальный размер файла - 1МБ')]
    public $photo;
    public function create() : void
    {
        $this->validate();

        if($this->is_edit){
            $this->client->update([
                'name'=>$this->name, 'phone' => $this->phone, 'site' => $this->site,
                'email' => $this->email,
                'team_id' => Auth::user()->currentTeam->id
            ]);
            $this->dispatch('notify', ['msg' => 'Клиент обновлен']);
        }else{
            if($this->photo){
                $avatar = new Attachment();
                $avatar->path = $this->photo->store('uploads', 'public');
                $avatar->type = 'avatar';
                $avatar->name = $this->name.'avatar';
                $avatar->team_id = Auth::user()->currentTeam->id;
                $avatar->user_id = Auth::user()->id;
                $avatar->save();

            }
            Client::create(['name'=>$this->name, 'phone' => $this->phone, 'site' => $this->site,
                'email' => $this->email,
                'logo_id' =>$avatar->id,
                'team_id' => Auth::user()->currentTeam->id]);
            $this->reset();
            $this->dispatch('notify', ['msg' => 'Клиент добавлен']);
        }

        //$this->dispatch('clients-list-updated', ['msg' => 'Клиент добавлен']);


    }

    public function mount($client = new Client()){
        if($client->name){$this->is_edit=true;}
       $this->client = $client;
       $this->name = $this->client->name;
       $this->site = $this->client->site;
       $this->phone = $this->client->phone;
       $this->email = $this->client->email;
    }

    public function render()
    {
        return view('livewire.client.create-client');
    }
}
