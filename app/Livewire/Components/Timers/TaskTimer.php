<?php

namespace App\Livewire\Components\Timers;

use App\Services\TimerService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class TaskTimer extends Component
{
    public $task_id;

    public $timer;

    public $state;

    public function start(TimerService $service)
    {
        if (! $service->isUserHasActiveTimer(Auth::id())) {

            if ($this->state == 'paused') {
                $this->timer->continue();
            } else {
                $this->timer = \App\Models\TaskTimer::create([
                    'task_id' => $this->task_id,
                    'started_at' => now()->toDateTimeString('second'),
                    'state' => 'started',
                    'user_id' => Auth::user()->id,
                    'team_id' => Auth::user()->currentTeam()->first()->id,

                ]);
            }
            $this->state = 'started';
            $this->dispatch('timer-updated');
        } else {
//            $this->dispatch('notify', ['msg' => ' «Делать две вещи одновременно — означает не сделать ни одной» - Публий Сир']);
            Toaster::info('«Делать две вещи одновременно — означает не сделать ни одной» - Публий Сир');
            //            $this->dispatch('notice',json_encode( ['type'=> 'success', 'text' => '🔥 Success!']));
            //            dd( json_encode(['type'=> 'success', 'text' => 'Success!']));
        }
    }

    public function pause(): void
    {
        $this->timer->pause();
        $this->state = 'paused';
        $this->dispatch('timer-updated');
    }

    public function stop()
    {
        $this->timer->stop();
        $this->state = 'stopped';
        $this->dispatch('timer-updated');
    }

    public function render()
    {
        return view('livewire.components.timers.task-timer');
    }

    public function mount($task_id)
    {
        $this->task_id = $task_id;
        $timer = Auth::user()->timers()->where('task_id', '=', $task_id)->get()->firstWhere('state', '!=', 'stopped');
        if ($timer) {
            $this->timer = $timer;
            $this->state = $this->timer->state;
        }
    }
}
