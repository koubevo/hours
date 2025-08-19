<?php

namespace App\Livewire\Ui;

use Livewire\Component;

class ButtonGroup extends Component
{
    public $buttons = [];

    public function mount(array $buttons)
    {
        $this->buttons = $buttons;    
    }

    public function render()
    {
        return view('livewire.ui.button-group');
    }
}
