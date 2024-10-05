<?php

namespace App\Livewire\Components\Timers;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Ramsey\Uuid\Type\Time;

class TimersModalList extends Component
{

public $active_timer;
public $paused_timers;
public $stopped_timers;




public function mount()
{
    $this->updateTimers();
}

    #[On('timer-updated')]
    public function updateTimers()
{
    $this->active_timer = Auth::user()->timers()->where('state', '=', 'started')->get()->first();
    $this->paused_timers = Auth::user()->timers()->where('state', '=', 'paused')->get();
    $this->stopped_timers = Auth::user()->timers()->where('state', '=', 'stopped')->get();
}

public function start()
{
    if($this->active_timer){
        $this->active_timer->continue();
        $this->active_timer->save();
    }

}

public function continue($id)
{
    if(!$this->active_timer){
        Auth::user()->timers()->find($id)->continue();
        $this->updateTimers();
    }
}

public function pauseActiveTimer(){

    $this->active_timer->pause();
    $this->updateTimers();
}

public function stop($id)
{
    Auth::user()->timers()->find($id)->stop();
    $this->updateTimers();
}


    public function render()
    {
        return view('livewire.components.timers.timers-modal-list');
    }
}
