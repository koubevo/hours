<?php

namespace App\View\Components\Forms;

use App\Models\Employee;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class HoursForm extends Component
{
    public Collection $employees;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->employees = Employee::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.forms.hours-form');
    }
}
