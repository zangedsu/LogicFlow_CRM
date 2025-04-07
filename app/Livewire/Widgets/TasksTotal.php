<?php

namespace App\Livewire\Widgets;

use App\Models\Task;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

//TODO: нужна оптимизация запросов к БД
class TasksTotal extends Component
{
    public $total_tasks;

    public $total_new_tasks;

    public $total_completed_tasks;

    public $rate;

    public $chartData;
    public $chartOptions;

    public function mount()
    {
        $this->total_tasks = Auth::user()->currentTeam
            ->tasks()
            ->count();

        $this->total_new_tasks = Auth::user()->currentTeam
            ->tasks()
            ->where('state', '=', 'new')
            ->count();

        $this->total_completed_tasks = Auth::user()->currentTeam
            ->tasks()
            ->where('state', '=', 'completed')
            ->count();

        if ($this->total_completed_tasks && $this->total_new_tasks) {
            $this->rate = round(($this->total_completed_tasks / $this->total_new_tasks) * 100);
        }

        $this->loadChartData();
    }

    public function loadChartData(): void
    {
        // Получаем текущую команду через Jetstream
        $team = Auth::user()->currentTeam;

        // Проверка: действительно ли это объект Team
        if (!$team instanceof \App\Models\Team) {
            $this->chartData = [];
            $this->chartOptions = [];
            return;
        }

        $statuses = [
            'new' => 'Новые',
            'in_progress' => 'В процессе',
            'completed' => 'Выполнено',
            'failed' => 'Отменено',
        ];

        $months = collect();
        $now = now();
        for ($i = 11; $i >= 0; $i--) {
            $months->push($now->copy()->subMonths($i)->format('Y-m'));
        }

        $labels = $months->map(fn($month) => Carbon::createFromFormat('Y-m', $month)->translatedFormat('F Y'))->toArray();

        // Получаем задачи через toBase() — обходим Eloquent баг с groupBy
        $rawData = $team->tasks()
            ->toBase()
            ->select(
                DB::raw("DATE_FORMAT(tasks.created_at, '%Y-%m') as month"),
                'tasks.state',
                DB::raw('COUNT(*) as total')
            )
            ->where('tasks.created_at', '>=', $months->first() . '-01')
            ->groupBy('month', 'tasks.state')
            ->get()
            ->groupBy('state');


        $colors = [
            'new' => ['rgba(255, 206, 86, 0.2)', 'rgba(255, 206, 86, 1)'],
            'in_progress' => ['rgba(54, 162, 235, 0.2)', 'rgba(54, 162, 235, 1)'],
            'completed' => ['rgba(75, 192, 192, 0.2)', 'rgba(75, 192, 192, 1)'],
            'failed' => ['rgba(255, 99, 132, 0.2)', 'rgba(255, 99, 132, 1)'],
        ];

        $datasets = [];

        foreach ($statuses as $status => $label) {
            $statusData = $rawData->get($status, collect())->keyBy('month');

            $monthlyCounts = $months->map(fn($month) =>
            $statusData->has($month) ? $statusData->get($month)->total : 0
            )->toArray();

            $datasets[] = [
                'label' => $label,
                'data' => $monthlyCounts,
                'backgroundColor' => $colors[$status][0],
                'fill' => 'origin',
                'borderColor' => $colors[$status][1],
                'borderWidth' => 1,
            ];
        }

        $this->chartData = [
            'labels' => $labels,
            'datasets' => $datasets,
        ];

        $this->chartOptions = [
            'responsive' => true,
            'maintainAspectRatio' => false,
            'height' => '300',
            'plugins' => [
                'legend' => ['position' => 'top'],
                'title' => [
                    'display' => true,
                    'text' => 'Задачи по статусам за последние 12 месяцев',
                ],
            ],
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => ['precision' => 0],
                ],
            ],
        ];
    }
    public function placeholder()
    {
        return view('components.sceleton');
    }

    public function render()
    {
        return view('livewire.widgets.tasks-total');
    }
}
