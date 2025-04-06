<?php

namespace App\Livewire\Components;

use Livewire\Component;

class Chart extends Component
{
    public $chartId;
    public $chartType;
    public $chartData;
    public $chartOptions;

    protected $rules = [
        'chartType' => 'required|in:bar,area,bubble,pie,doughnut,line,polarArea,radar,scatter',
        'chartData' => 'required|array',
        'chartOptions' => 'nullable|array',
    ];

    public function mount($chartType = 'bar', $chartData = [], $chartOptions = [])
    {
        $this->chartId = 'chart_' . uniqid();
        $this->chartType = $chartType;

        // 🛠 Исправление: проверяем, что datasets всегда массив
        if (!isset($chartData['datasets']) || !is_array($chartData['datasets'])) {
            $chartData['datasets'] = [];
        }

        $this->chartData = $chartData;
        $this->chartOptions = $chartOptions;


        $this->validate();
    }


    public function render()
    {
        return view('livewire.components.chart');
    }
}
