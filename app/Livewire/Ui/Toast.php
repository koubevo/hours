<?php

namespace App\Livewire\Ui;

use Livewire\Component;

class Toast extends Component
{

    public bool $success = true;
    public string $message = '';
    public string $icon = 'shield-check';

    public function render()
    {
        return view('livewire.ui.toast');
    }
}
