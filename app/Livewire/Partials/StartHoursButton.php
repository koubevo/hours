<?php

namespace App\Livewire\Partials;

use Livewire\Component;

class StartHoursButton extends Component
{
    public int $employeeId;

    public function navigate(): \Symfony\Component\HttpFoundation\Response
    {
        return redirect()->route('hours.create', [
            'employee' => $this->employeeId,
        ]);
    }

    public function render()
    {
        return view('livewire.partials.start-hours-button');
    }
}
