<?php

namespace App\Livewire\Forms;

use App\Models\Employee;
use Livewire\Component;

class NewEmployeeForm extends Component
{
    public string $name;
    public ?string $nickname;
    public ?int $hour_rate;

    protected $rules = [
        'name' => 'required|string|max:255',
        'nickname' => 'nullable|string|max:255',
        'hour_rate' => 'nullable|integer|min:1|max:1000',
    ];

    public function store()
    {
        $this->validate();

        Employee::create([
            'name' => $this->name,
            'nickname' => $this->nickname ?? null,
            'hour_rate' => $this->hour_rate ?? null
        ]);

        $this->reset();
        session()->flash('success', 'Zaměstnanec byl přidán.');

        return redirect()->route('admin.dashboard');
    }

    public function render(
    ) {
        return view('livewire.forms.new-employee-form');
    }
}
