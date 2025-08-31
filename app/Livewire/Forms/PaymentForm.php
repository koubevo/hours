<?php

namespace App\Livewire\Forms;

use App\Enum\HoursStatus;
use App\Models\Hour;
use App\Models\Employee;
use App\Models\Payment;
use App\Support\HoursCalculator;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class PaymentForm extends Component
{
    public Collection $employees;
    public Employee|string|int|null $employee;
    public $payment_date;
    public float $amount;

    // For edit mode
    public Payment $payment;
    public ?int $paymentId;
    public bool $isEditMode = false;

    protected $rules = [
        'employee' => 'required|exists:employees,id',
        'payment_date' => 'required|date',
        'amount' => 'required|decimal:0,2|min:1|max:100000',
    ];

    public function mount($employee = null, $payment_id = null)
    {
        $this->employees = Employee::all();

        if ($payment_id) {
            // Edit mode
            $this->isEditMode = true;
            $this->paymentId = $payment_id;
            $this->payment = Payment::findOrFail($payment_id);
            $this->employee = $this->payment->employee_id;
            $this->payment_date = $this->payment->payment_date;
            $this->fill($this->payment->except(['employee_id']));
        } else {
            // Create mode
            $this->employee = $employee ? $employee : 0;
            $this->payment_date = now()->format('Y-m-d');
        }
    }

    public function render()
    {
        return view('livewire.forms.payment-form');
    }

    public function save()
    {
        $validated = $this->validate();

        $debt = Employee::findOrFail($validated['employee'])->debt();

        if ($this->isEditMode) {
            $debt += $this->payment->amount;
        }

        if ($debt - $validated['amount'] >= 0) {
            $data = collect($validated)
                ->except(['employee'])
                ->put('employee_id', $validated['employee'])
                ->toArray();

            if ($this->isEditMode) {
                $this->payment->update($data);
                session()->flash('success', 'Platba byla aktualizována.');
            } else {
                Payment::create($data);
                session()->flash('success', 'Platba byla přidána.');
            }
        } else {
            session()->flash('failure', 'Platba nebyla přidána: dluh by byl záporný.');
        }

        return redirect()->route('employee.show', [$validated['employee']]);
    }
}
