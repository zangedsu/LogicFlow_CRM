<?php

namespace App\Livewire\Reports;

use App\Models\Project;
use App\Services\TimerService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Full extends Component
{

    public $result_chart_categories = [];

    public $timers;

    public $time_total;

    // FILTERS - dates
    public $date_from = null;

    public $date_to = null;

    public $date_range = "" ;

    // FILTERS - projects

    public $found_projects;

    public $selected_project;

    public $search_project_input;

    // сотрудники
    public $found_employees;
    public $selected_employee;
    public $search_employees;

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

    public function selectEmployee ($employee_id)
    {
        if($employee_id) {
            $this->selected_employee = Auth::user()->currentTeam()->first()->members()->find($employee_id);
        }else {
            $this->selected_project = null;
        }
        $this->search_employees = $this->selected_employee?->name;
    }

    public function exportToCsv()
    {
        dd($this->taskStatData);
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
        // По умолчанию ставим текущий месяц, если не указано
        if (!$this->date_from || !$this->date_to) {
//            $this->date_from = now()->startOfMonth()->toDateString();
            $this->date_from = now()->subMonth()->startOfMonth()->toDateString();
            $this->date_to = now()->endOfMonth()->toDateString();
        }

        // Заполняем date_range при инициализации
        $this->syncDateRangeFromParts();


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

//        $labels = ['Новые задачи', 'Задачи в работе', 'Выполненные задачи', 'Неудавшиеся задачи'];
//        $colors = ['#1C64F2', '#16BDCA', '#FDBA8C', '#E74694'];
//        $this->taskStatParams = ['labels' => $labels, 'data' => $data, 'colors' => $colors, 'chart_type' => 'donut', 'title' => 'Статистика задач', 'subtitle' => 'За выбранный период'];
//        $this->taskStatData = $data;

        $this->taskStatData = array(
            'labels' => ['Новые задачи', 'Задачи в работе', 'Выполненные задачи', 'Неудавшиеся задачи'],
            'datasets' => [
                [
                    'label' => 'Новые задачи',
                    'data' => [$data[0]],
                    'fill' => 'origin',
                    'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
                    'borderColor' => 'rgba(75, 192, 192, 1)',
                    'borderWidth' => 1
                ],
                [
                    'label' => 'Задачи в работе',
                    'data' => [$data[1]],
                    'fill' => 'origin',
                    'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
                    'borderColor' => 'rgba(32, 180, 192, 1)',
                    'borderWidth' => 1
                ],
                [
                    'label' => 'Выполненные задачи',
                    'data' => [$data[2]],
                    'fill' => 'origin',
                    'backgroundColor' => 'rgba(79, 123, 192, 0.2)',
                    'borderColor' => 'rgba(65, 192, 192, 1)',
                    'borderWidth' => 1
                ],
                [
                    'label' => 'Неудавшиеся задачи',
                    'data' => [$data[3]],
                    'fill' => 'origin',
                    'backgroundColor' => 'red',
                    'borderColor' => 'rgba(65, 192, 192, 1)',
                    'borderWidth' => 1
                ],
                ]
        );
    }

    public function updatedDateFrom(): void
    {
        $this->syncDateRangeFromParts();
    }

    public function updatedDateTo(): void
    {
        $this->syncDateRangeFromParts();
    }

    protected function syncDateRangeFromParts(): void
    {
        if ($this->date_from && $this->date_to) {
            $this->date_range = "{$this->date_from} — {$this->date_to}";
        } else {
            $this->date_range = '';
        }
    }

    public function render(TimerService $timerService)
    {
        $this->generateTaskStatData();
        $this->time_total = $timerService->getUserTotalDuration(Auth::id(), $this->date_from, $this->date_to, $this->selected_project?->id);
        $this->found_projects = Auth::user()->currentTeam()->first()->projects()->where('projects.name', 'like', '%'.$this->search_project_input.'%')->get();
        $this->found_employees = Auth::user()->currentTeam()->first()->members()->where('name', 'like', '%'.$this->search_employees.'%')->get();
//        $this->found_employees = Auth::user()->currentTeam()->first()->members()->get();

        return view('livewire.reports.full');
    }
}
