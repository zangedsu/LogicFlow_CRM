<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class badge extends Component
{
    /**
     * Create a new component instance.
     */
    public $state;

    public function __construct($state)
    {
        $this->state = $state;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.badge');
    }
}
