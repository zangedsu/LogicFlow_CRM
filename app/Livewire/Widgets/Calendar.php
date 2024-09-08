<?php

namespace App\Livewire\Widgets;

use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Livewire\Component;

class Calendar extends Component
{

    public $calendar_data;
    public $currentDate;
    public $currentMonth;
    public $currentYear;
    public $daysInMonth;

    public function mount()
    {
        $currentDate = Carbon::now();
        $currentMonth = $currentDate->month;
        $currentYear = $currentDate->year;
        $daysInMonth = $currentDate->daysInMonth;



        for ($day = 1; $day <= 42; $day++) {
            $this->calendar_data[] = [
                'day' => $day,
                'month' => $currentMonth,
                'year' => $currentYear,
            ];
        }
//        dd($this->calendar_data);
    }

    public function render()
    {
        return view('livewire.widgets.calendar');
    }
}
