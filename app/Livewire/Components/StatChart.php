<?php

namespace App\Livewire\Components;

use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class StatChart extends Component
{
    public $title;
    public $subtitle;

#[Reactive]
    public $data;
    public $chart_id;

    public $chart_type;

    public $categories = [];
    public $labels = [];

    public $colors = [];



//    public function mount($data ,$categories=[], $chart_type = 'area', $title ='', $subtitle = '', $labels = [], $colors = [])
//    {
//        $this->categories = $categories;
//        $this->data = $data;
//        $this->title = $title;
//        $this->subtitle = $subtitle;
//        $this->chart_type = $chart_type;
//        $this->labels = $labels;
//        $this->colors = $colors;
//    }

    public function mount($data, $params)
{
    $this->data = $data;

    $this->categories = $params['categories'] ?? null;
    $this->title = $params['title'] ?? null;
    $this->subtitle = $params['subtitle'] ?? null;
    $this->chart_type = $params['chart_type'] ?? null;
    $this->labels = $params['labels'] ?? null;
    $this->colors = $params['colors'] ?? null;
}


    public function render()
    {
        $this->chart_id = Str::random(6);
        return view('livewire.components.stat-chart');
    }
}
