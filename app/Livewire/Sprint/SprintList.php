<?php

namespace App\Livewire\Sprint;

use App\Models\Sprint;
use Livewire\Component;

class SprintList extends Component
{
    public ?int $projectId = null;

    public $editingSprintId = null;
    public $editData = [];

    public function mount(?int $projectId = null)
    {
        $this->projectId = $projectId;
    }

    public function getSprintsProperty()
    {
        $query = Sprint::with('project');

        if ($this->projectId) {
            $query->where('project_id', $this->projectId);
        }

        return $query->orderByDesc('created_at')->get()->map(function ($sprint) {
            $sprint->deadline_status = match (true) {
                now()->gt($sprint->end_date) => 'overdue',
                now()->diffInDays($sprint->end_date, false) <= 3 => 'soon',
                default => 'ok',
            };
            $sprint->progress = $sprint->progress ?? 0;
            return $sprint;
        });
    }

    public function startEditing($id)
    {
        $sprint = $this->sprints->firstWhere('id', $id);
        $this->editingSprintId = $id;
        $this->editData = [
            'name' => $sprint->name,
            'description' => $sprint->description,
            'end_date' => $sprint->end_date->format('Y-m-d'),
        ];
    }

    public function cancelEditing()
    {
        $this->editingSprintId = null;
        $this->editData = [];
    }

    public function updateSprint()
    {
        $this->validate([
            'editData.name' => 'required|string|max:255',
            'editData.description' => 'nullable|string',
            'editData.end_date' => 'required|date',
        ]);

        $sprint = Sprint::findOrFail($this->editingSprintId);
        $sprint->update($this->editData);

        $this->editingSprintId = null;
        $this->editData = [];

        session()->flash('message', 'Спринт обновлён.');
    }

    public function render()
    {
        return view('livewire.sprint.sprint-list', [
            'sprints' => $this->sprints,
        ]);
    }
}
