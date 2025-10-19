<?php

namespace App\Livewire\Forms;

use App\Models\Employee;
use Livewire\Component;

class EditEmployeeForm extends Component
{
    public Employee $employee;

    public string $name;

    public ?int $hour_rate;

    public function mount(Employee $employee)
    {
        $this->employee = $employee;
        $this->name = $employee->name;
        $this->hour_rate = $employee->hour_rate;
    }

    protected $rules = [
        'name' => 'required|string|max:255',
        'hour_rate' => 'nullable|integer|min:1|max:1000',
    ];

    public function update()
    {
        $this->validate();

        $this->employee->update([
            'name' => $this->name,
            'hour_rate' => $this->hour_rate ?? null,
        ]);

        session()->flash('success', 'Zaměstnanec byl upraven.');

        return redirect()->route('admin.dashboard');
    }

    public function render()
    {
        return view('livewire.forms.edit-employee-form');
    }
}
