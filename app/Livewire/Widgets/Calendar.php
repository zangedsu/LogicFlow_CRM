<?php

namespace App\Livewire\Widgets;

use App\Models\Sprint;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Calendar extends Component
{
    public $calendar_data;

    public $events;

    public $view_type;

    public $day;

    public $week;

    public $month;

    public $year;

    public $project;

    public function mount($view_type = 'month', $day = null, $week = null, $month = null, $year = null, $project = null)
    {
        $this->day = $day;
        $this->week = $week;
        $this->month = $month;
        $this->year = $year;
        $this->view_type = $view_type;
        $this->project = $project;

        //        $this->getEvents();

        $this->generateCalendarDates();

        //        dd(Auth::user()->currentTeam()->first()->sprints()->get());
    }

    public function generateCalendarDates()
    {
        $currentDate = Carbon::now();
        //        dd($currentDate->toDateTimeString());

        $startOfMonth = Carbon::createFromDate($currentDate->year, $currentDate->month, 1);

        // Находим последний понедельник прошлого месяца
        $lastMondayOfPrevMonth = $startOfMonth->copy()->startOfMonth()->previous(Carbon::MONDAY);

        // Добавляем даты прошлого месяца в массив, начиная с последнего понедельника прошлого месяца
        $dates = [];
        while ($lastMondayOfPrevMonth->month < $startOfMonth->month) {
            $dates[] = $lastMondayOfPrevMonth->copy();
            $lastMondayOfPrevMonth->addDay();
        }

        // Добавляем даты текущего месяца в массив
        while ($startOfMonth->month === $currentDate->month) {
            $dates[] = $startOfMonth->copy();
            $startOfMonth->addDay();
        }

        // Добавляем даты следующего месяца до заполнения всех ячеек в календаре
        while (count($dates) < 42) {
            $dates[] = $startOfMonth->copy();
            $startOfMonth->addDay();
        }

        $this->calendar_data = $dates;

    }

    public function changeViewType($view_type)
    {
        $this->view_type = $view_type;
    }

    public function getTasksDeadlines($date)
    {
        if ($this->project) {
            return Auth::user()->currentTeam()->first()->tasks()
                ->whereDate('deadline', '=', $date->toDateString())
                ->where('project_id', '=', $this->project)
                ->get();
        }

        return Auth::user()->currentTeam()->first()->tasks()->whereDate('deadline', '=', $date->toDateString())->get();
    }

    public function getEvents($date)
    {
        return Auth::user()->currentTeam()->first()->events()->whereDate('date_time', '=', $date->toDateString())->get();
    }

    public function getSprintsStart($date)
    {
        return Auth::user()->currentTeam()->first()->sprints()->whereDate('end_date', '=', $date->toDateString())->get();
    }

    public function getSprintsForDate($date)
    {
//        $query = Auth::user()->currentTeam()->first()->sprints;
        $query = Sprint::query();

        if ($this->project) {
            $query->where('project_id', '=', $this->project);
        }

        return $query->whereDate('start_date', '<=', $date->toDateString())
            ->whereDate('end_date', '>=', $date->toDateString())
            ->get();
    }


    public function getTime($dateTime): string
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $dateTime)->toTimeString('minute');
    }

    public function render()
    {
        return view('livewire.widgets.calendar');
    }
}
