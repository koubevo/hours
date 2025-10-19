<?php

namespace App\Livewire\Layouts;

use Livewire\Component;

class AdminLayout extends Component
{
    public function render()
    {
        return view('livewire.layouts.admin-layout');
    }

    public function navigateToRoute($employee = null)
    {
        return redirect()->route('hours.create', [
            'employee' => $employee,
        ]);
    }
}
