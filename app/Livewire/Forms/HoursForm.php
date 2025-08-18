<?php

namespace App\Livewire\Forms;

use App\Models\Employee;
use Livewire\Component;

class HoursForm extends Component
{
    public $employees;
    public $employee;
    public $hour_rate;
    public $work_date;
    public $start_time;
    public $end_time;
    public $description;

    public function mount($employee = null, $date = null)
    {
        $this->employees = Employee::all();

        // Set employee if provided in URL
        if ($employee) {
            $this->employee = $employee;
            $this->updateHourRate();
        }

        // Set date if provided in URL, otherwise use current date
        $this->work_date = $date ?: now()->format('Y-m-d');
    }

    public function updateHourRate()
    {
        if ($this->employee) {
            $selectedEmployee = Employee::find($this->employee);
            if ($selectedEmployee) {
                $this->hour_rate = $selectedEmployee->hour_rate ?? 0;
            }
        }
    }

    public function render()
    {
        return view('livewire.forms.hours-form');
    }
}
