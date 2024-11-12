<?php

namespace App\Livewire\Task;

use App\Models\Task;
use App\Models\TaskNote;
use Illuminate\Support\Carbon;
use Livewire\Component;

class Comments extends Component
{
    public $task_id;

    public $comments;

    public $comment_text;

    public function sendComment()
    {
        TaskNote::create([
            'task_id' => $this->task_id,
            'text' => $this->comment_text,
            'user_id' => auth()->id(),
        ]);
        $this->reset('comment_text');
    }

    public function getFormattedTime($datetime)
    {
        return Carbon::parse($datetime)->locale('ru')->diffForHumans();
    }

    public function mount(): void {}

    public function render()
    {
        $this->comments = Task::find($this->task_id)?->notes()->get();

        return view('livewire.task.comments');
    }
}
