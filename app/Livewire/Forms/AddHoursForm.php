<?php

namespace App\Livewire\Forms;

use App\Models\Employee;
use Livewire\Component;

class AddHoursForm extends Component
{
    public $employee;
    public $work_date;
    public $hour_rate;

    public function mount($preselectedEmployee = null, $preselectedDate = null)
    {
        if ($preselectedEmployee) {
            $this->employee = $preselectedEmployee;
            $this->updateHourRate();
        }

        if ($preselectedDate) {
            $this->work_date = $preselectedDate;
        } else {
            $this->work_date = now()->format('Y-m-d');
        }
    }

    public function updatedEmployee()
    {
        $this->updateHourRate();
    }

    protected function updateHourRate()
    {
        if ($this->employee) {
            $selectedEmployee = Employee::find($this->employee);
            if ($selectedEmployee) {
                $this->hour_rate = $selectedEmployee->hour_rate;
            }
        }
    }

    public function render()
    {
        return view('livewire.forms.add-hours-form');
    }
}
