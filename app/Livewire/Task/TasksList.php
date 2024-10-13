<?php

namespace App\Livewire\Task;


use App\Models\Task;
use App\Models\TaskTimer;
use App\Services\TimerService;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\Guard;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class TasksList extends Component
{

    use WithPagination;
    public $per_page;
    public $navigate_links;
    public $project_id;
    public $tasks;
    public $states = ['new'=>'Новая', 'in_process'=>'В работе', 'completed'=>'Завершена', 'failed'=>'Не удалась'];
    public $is_user_has_active_timer;

    //filters
    public $show_only_expired_tasks = false;

    public function changeTaskState($task_id, $state)
    {
//        $states = ['new', 'in_process', 'completed', 'failed'];
        $task = Task::find($task_id);

        if($task && array_key_exists($state, $this->states)){
            $task->state = $state;
            $task->save();
        } else {abort(403);}
    }

    public function startTimer($task_id){

        if(!$this->is_user_has_active_timer){
            $task = Auth::user()->currentTeam()->first()->tasks()->find($task_id);
            if($task){
                $task->state = 'in_process';
                $task->save();
                TaskTimer::create([
                    'task_id' => $task_id,
                    'started_at' => now()->toDateTimeString('second'),
                    'state' => 'started',
                    'user_id' => Auth::user()->id,
                    'team_id' => Auth::user()->currentTeam()->first()->id,
                ]);
            }
            $this->dispatch('timer-updated');
        }
    }

    public function deleteTask($task_id){
        if(Auth::user()->hasTeamPermission(Auth::user()->currentTeam()->first(), 'delete')){
            Auth::user()->currentTeam()->first()->tasks->find($task_id)->delete();
        }else{abort(403);}
    }
    public function mount($tasks = null, $per_page = 10, $navigate_links = true) : void
    {
//        dd(Auth::user()->hasTeamPermission(Auth::user()->currentTeam()->first(), 'delete'));
        if(request('only_expired')){
            $this->show_only_expired_tasks = true;
        }

        if($tasks){
            $this->$tasks = $tasks;
        }else{
            if($this->show_only_expired_tasks){
                $this->tasks = Auth::user()->currentTeam()->first()->tasks()->get();
            }else{
                $this->tasks = Auth::user()->currentTeam()->first()->tasks()->where('deadline', '>', now())->get();
            }
        }


        $this->per_page = $per_page;
        $this->navigate_links = $navigate_links;

    }

    #[On('timers-state-updated')]
    public function updateTimersState(TimerService $service){
        $this->is_user_has_active_timer = $service->isUserHasActiveTimer(Auth::id());
    }


    public function render(TimerService $service)
    {
        $this->is_user_has_active_timer = $service->isUserHasActiveTimer(Auth::id());
//        $tasks = null;
        if(count($this->tasks) != 0){$tasks = $this->tasks->toQuery()->latest()->paginate($this->per_page); }
        return view('livewire.task.tasks-list', ['paginated_tasks' => $tasks]);
    }
}
