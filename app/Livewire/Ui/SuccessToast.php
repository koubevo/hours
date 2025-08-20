<?php

namespace App\Livewire\Ui;

use Livewire\Component;

class SuccessToast extends Component
{
    public string $message = '';

    public function render()
    {
        return view('livewire.ui.success-toast');
    }
}
