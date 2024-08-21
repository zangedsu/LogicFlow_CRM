<?php

namespace App\Livewire\Client;

use App\Actions\Attachment\DeleteAttachmentAction;
use App\Actions\Attachment\StoreAttachmentAction;
use App\Models\Attachment;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\WithFileUploads;
use mysql_xdevapi\Collection;
use function Livewire\store;

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
    #[Validate('nullable')]
    public $phone;
    #[Validate('url', message: 'Введите корректный URL (https://google.com)')]
    #[Validate('nullable')]
    public $site;

    #[Validate('email', message: 'Введите корректный адрес Email')]
    #[Validate('nullable')]
    public $email;

    #[Validate('image', message: 'Выберите изображение (JPEG, PNG, GIF')]
    #[Validate('max:1024', message: 'Максимальный размер файла - 1МБ')]
    #[Validate('nullable')]
    public $uploaded_photo;
    public $client_logo_path;

    public function create(StoreAttachmentAction $action) : void
    {
        $this->validate();

        if($this->is_edit){
            if($this->uploaded_photo){
                $logo_id = $action->store($this->uploaded_photo, 'uploads', 'avatar', $this->name .'_logo');
            }
            $this->client->update([
                'name'=>$this->name, 'phone' => $this->phone, 'site' => $this->site,
                'email' => $this->email,
                'logo_id' => $logo_id ?? null,
                'team_id' => Auth::user()->currentTeam->id
            ]);
            $this->reset('uploaded_photo');
            $this->dispatch('notify', ['msg' => 'Клиент обновлен']);
        }else{
            if($this->uploaded_photo){
                $logo_id = $action->store($this->uploaded_photo, 'uploads', 'avatar', 'Avatar');
            }
            Client::create(['name'=>$this->name, 'phone' => $this->phone, 'site' => $this->site,
                'email' => $this->email,
                'logo_id' => $logo_id ?? null,
                'team_id' => Auth::user()->currentTeam->id]);
            $this->reset();
            $this->dispatch('notify', ['msg' => 'Клиент добавлен']);
        }

        //$this->dispatch('clients-list-updated', ['msg' => 'Клиент добавлен']);

        $this->reset('client_logo_path');
    }

    public function unsetLogo(DeleteAttachmentAction $action)
    {
       $action->delete($this->client->logo_id);
       $this->client_logo_path = null;
    }

    public function mount($client = new Client()){
        if($client->name){
            $this->is_edit=true;
        }
       $this->client = $client;
       $this->name = $client->name;
       $this->site = $client->site;
       $this->phone = $client->phone;
       $this->email = $client->email;
       $this->client_logo_path = $client->logo()->first()?->path;
    }

    public function render()
    {
        return view('livewire.client.create-client');
    }
}
