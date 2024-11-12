<?php

namespace App\Livewire\Reports;

use App\Models\Project;
use App\Services\TimerService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Full extends Component
{
    public $tasks_chart_categories = [];

    public $tasks_chart_data = [];

    public $result_chart_data = [];

    public $result_chart_categories = [];

    public $timers;

    public $time_total;

    // FILTERS - dates
    public $date_from = null;

    public $date_to = null;

    // FILTERS - projects

    public $found_projects;

    public $selected_project;

    public $search_project_input;

    //chart data
    public $taskStatData = [];

    public $taskStatParams = [];

    public function selectProject($project_id)
    {
        if ($project_id) {
            $this->selected_project = Auth::user()->currentTeam()->first()->projects()->find($project_id);
        } else {
            $this->selected_project = null;
        }
        $this->search_project_input = $this->selected_project?->name;
    }

    public function exportToCsv()
    {
        // Получение данных, которые нужно выгрузить в CSV

        // Формирование CSV-файла
        $data = [
            ['Название:' => 'Общий отчет'],
            ['Начало периода:' => $this->date_from ?? '-'],
            ['Конец периода:' => $this->date_to ?? '-'],
            ['Проект:' => $this->selected_project->name ?? '-'],
            ['Сотрудник:' => Auth::user()->name],
            [
                'Итого часов: ' => $this->time_total['h'],
                'минут: ' => $this->time_total['m'],
                'секунд: ' => $this->time_total['s'],
            ],

        ];
        //        $csv = implode(',', $headers) . "\r\n";
        $csv = '';
        foreach ($data as $row) {
            $csvRow = [];
            foreach ($row as $key => $value) {
                $csvRow[] = $key;
                $csvRow[] = $value;
            }
            $csv .= implode(',', $csvRow)."\r\n";
        }

        return response()->streamDownload(function () use ($csv) {
            echo $csv;
        }, 'report.csv');
    }

    public function mount(TimerService $timerService)
    {
        $this->tasks_chart_categories = ['01', '02', '03', '04', '05'];
        $this->tasks_chart_data = [
            ['name' => 'Задач всего', 'data' => [6590, 6418, 6456, 6526, 6353], 'color' => '#1A56DB'],
            ['name' => 'Задач всего', 'data' => [6450, 6118, 6556, 6426, 6396], 'color' => '#c73d99'],
        ];

        $this->generateTaskStatData();

        $this->timers = Auth::user()->timers()->get();
        $this->time_total = $timerService->getUserTotalDuration(Auth::id());

        if (request()->has('project')) {
            $this->selected_project = Project::find(request('project'));
            $this->search_project_input = $this->selected_project?->name;
        }
    }

    public function generateTaskStatData(): void
    {
        if ($this->selected_project) {
            $query = $this->selected_project->tasks();
        } else {
            $query = Auth::user()->currentTeam()->first()->tasks();
        }
        $query->selectRaw('state, COUNT(*) as count');
        if ($this->date_from) {
            $query->where('tasks.created_at', '>=', $this->date_from);
        }

        if ($this->date_to) {
            $query->where('tasks.created_at', '<=', $this->date_to);
        }

        $taskCounts = $query->groupBy('state')->pluck('count', 'state');

        $data = [
            $taskCounts->get('new', 0),
            $taskCounts->get('in_process', 0),
            $taskCounts->get('completed', 0),
            $taskCounts->get('failed', 0),
        ];

        $labels = ['Новые задачи', 'Задачи в работе', 'Выполненные задачи', 'Неудавшиеся задачи'];
        $colors = ['#1C64F2', '#16BDCA', '#FDBA8C', '#E74694'];
        $this->taskStatParams = ['labels' => $labels, 'data' => $data, 'colors' => $colors, 'chart_type' => 'donut', 'title' => 'Статистика задач', 'subtitle' => 'За выбранный период'];
        $this->taskStatData = $data;
    }

    public function render(TimerService $timerService)
    {
        $this->generateTaskStatData();
        $this->time_total = $timerService->getUserTotalDuration(Auth::id(), $this->date_from, $this->date_to, $this->selected_project?->id);
        $this->found_projects = Auth::user()->currentTeam()->first()->projects()->where('projects.name', 'like', '%'.$this->search_project_input.'%')->get();

        return view('livewire.reports.full');
    }
}
