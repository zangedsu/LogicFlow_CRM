<?php

namespace App\Livewire\Components\Timers;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TimersModalList extends Component
{

public $active_timer;
public $paused_timers;
public $stopped_timers;

public $test = 0;

public function plus(){
    $this->test++;
}

public function mount()
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

public function pauseActiveTimer(){
    $this->active_timer->pause()->save();
    dd($this);
}


    public function render()
    {
        return view('livewire.components.timers.timers-modal-list');
    }
}
