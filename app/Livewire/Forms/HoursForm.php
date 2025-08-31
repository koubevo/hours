<?php

namespace App\Livewire\Forms;

use App\Enum\HoursStatus;
use App\Models\Hour;
use App\Models\Employee;
use App\Support\HoursCalculator;
use DateTime;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class HoursForm extends Component
{
    public Collection $employees;
    public Employee|string|int $employee;
    public $work_date;
    public $start_time;
    public $end_time;
    public ?string $description;
    public ?int $hour_rate;

    // For edit mode
    public Hour $hour;
    public int $hourId;
    public bool $isEditMode = false;

    protected $rules = [
        'employee' => 'required|exists:employees,id',
        'work_date' => 'required|date',
        'start_time' => 'required|date_format:H:i',
        'end_time' => 'nullable|date_format:H:i',
        'description' => 'nullable|string|max:10000',
        'hour_rate' => 'nullable|integer|min:0|max:100000',
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
            $this->employee = $employee ? $employee : 0;
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

        $data = collect($validated)
            ->except(['hour_rate', 'employee'])
            ->put('employee_id', $validated['employee'])
            ->toArray();

        if (isset($data['end_time']) && $data['end_time'] !== "") {
            $data['status'] = HoursStatus::Completed;
            $data['earning'] = HoursCalculator::calculateEarning(
                $validated['start_time'],
                $validated['end_time'],
                $validated['hour_rate'] ?? 0
            );
        } else {
            $data['end_time'] = null;
            $data['earning'] = 0;
            $data['status'] = HoursStatus::Draft;
        }

        if ($this->isEditMode) {
            $this->hour->update($data);
            session()->flash('success', 'Hodiny byly aktualizovány.');
        } else {
            Hour::create($data);
            session()->flash('success', 'Hodiny byly přidány.');
        }

        return redirect()->route('admin.dashboard');
    }
}
