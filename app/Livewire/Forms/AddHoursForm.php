<?php

namespace App\Livewire\Forms;

use App\Models\Hour;
use App\Support\HoursCalculator;
use Livewire\Component;
use Carbon\Carbon;

class AddHoursForm extends Component
{
    public $employee;
    public $work_date;
    public $start_time;
    public $end_time;
    public $description;
    public $hour_rate;

    protected $rules = [
        'employee' => 'required|exists:employees,id',
        'work_date' => 'required|date',
        'start_time' => 'required|date_format:H:i',
        'end_time' => 'required|date_format:H:i',
        'description' => 'nullable|string|max:10000',
        'hour_rate' => 'nullable|integer|min:1|max:100000',
    ];

    public function mount($preselectedEmployee = null, $preselectedDate = null)
    {
        $this->employee = $preselectedEmployee ?? null;

        $this->work_date = $preselectedDate ? $preselectedDate : now()->format('Y-m-d');
    }

    public function render()
    {
        return view('livewire.forms.add-hours-form');
    }

    public function store()
    {
        $validated = $this->validate();

        $earning = HoursCalculator::calculateEarning(
            $validated['start_time'], 
            $validated['end_time'], 
            $validated['hour_rate'] ?? 0
        );

        Hour::create(
            collect($validated)
                ->except(['hour_rate'])
                ->merge(['earning' => $earning])
                ->toArray()
        );

        $this->reset();
        session()->flash('message', 'Hodiny byly přidány.');

        return redirect()->route('admin.dashboard');
    }
}
