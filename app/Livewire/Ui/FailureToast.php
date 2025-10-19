<?php

namespace App\Livewire\Ui;

use Livewire\Component;

class FailureToast extends Component
{
    public string $message = '';

    public function render()
    {
        return view('livewire.ui.failure-toast');
    }
}
