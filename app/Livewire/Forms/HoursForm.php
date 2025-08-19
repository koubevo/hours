<?php

namespace App\Livewire\Forms;

use App\Models\Hour;
use App\Models\Employee;
use App\Support\HoursCalculator;
use Livewire\Component;

class HoursForm extends Component
{
    public $employees;
    public $employee;
    public $work_date;
    public $start_time;
    public $end_time;
    public $description;
    public $hour_rate;
    
    // For edit mode
    public $hour;
    public $hourId;
    public $isEditMode = false;

    protected $rules = [
        'employee' => 'required|exists:employees,id',
        'work_date' => 'required|date',
        'start_time' => 'required|date_format:H:i',
        'end_time' => 'required|date_format:H:i',
        'description' => 'nullable|string|max:10000',
        'hour_rate' => 'nullable|integer|min:1|max:100000',
    ];

    public function mount($employee = null, $date = null, $hour_id = null)
    {
        $this->employees = Employee::all();
        
        if ($hour_id) {
            // Edit mode
            $this->isEditMode = true;
            $this->hourId = $hour_id;
            $this->hour = Hour::findOrFail($hour_id);
            $this->employee = $this->hour->employee_id;
            $this->fill($this->hour->except(['employee_id']));
        } else {
            // Create mode
            $this->employee = $employee;
            $this->work_date = $date ?: now()->format('Y-m-d');
        }
        
        if ($this->employee) {
            $this->updateHourRate();
        }
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

    public function save()
    {
        $validated = $this->validate();

        $earning = HoursCalculator::calculateEarning(
            $validated['start_time'], 
            $validated['end_time'], 
            $validated['hour_rate'] ?? 0
        );

        $data = collect($validated)
            ->except(['hour_rate', 'employee'])
            ->put('employee_id', $validated['employee'])
            ->put('earning', $earning)
            ->toArray();

        if ($this->isEditMode) {
            $this->hour->update($data);
            session()->flash('message', 'Hodiny byly aktualizovány.');
        } else {
            Hour::create($data);
            session()->flash('message', 'Hodiny byly přidány.');
        }

        return redirect()->route('admin.dashboard');
    }
}
