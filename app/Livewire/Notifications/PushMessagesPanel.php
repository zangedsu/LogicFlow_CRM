<?php

namespace App\Livewire\Notifications;

use Composer\Script\Event;
use Illuminate\Support\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

class PushMessagesPanel extends Component
{
    public $notifications;

    public function __construct(){
        $this->notifications = new Collection();
    }

    #[On('notify')]
    public function addMessage($data)
    {
//       $this->notifications[] =
//           ['text' => $data['msg'], 'route' => $data['route']];
//       $this->notifications = collect([
//           ['text' => $data['msg'], 'route' => $data['route']]
//       ]);

//        $data['id'] = rand(999, 9999999);
        $data['id'] = 90;
        $this->notifications->prepend($data);

    }


    public function hideFirstNotification(){
        $this->notifications->shift();
    }

    public function hideNotification($index)
    {
        $this->notifications->forget($this->notifications->where('id', '=', $index)->keys()->first());

    }

    public function render()
    {
        return view('livewire.notifications.push-messages-panel');
    }
}
