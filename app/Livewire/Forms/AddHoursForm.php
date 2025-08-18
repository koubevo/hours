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
        $this->employee = $preselectedEmployee ?? null;

        $this->work_date = $preselectedDate ? $preselectedDate : now()->format('Y-m-d');
    }

    public function render()
    {
        return view('livewire.forms.add-hours-form');
    }
}
