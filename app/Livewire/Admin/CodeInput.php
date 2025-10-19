<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class CodeInput extends Component
{
    public string $code = '';

    public function submit()
    {
        if ($this->code === env('ADMIN_CODE')) {
            session()->put('is_admin', true);

            return redirect()->route('admin.dashboard');
        }

        $this->addError('code', 'Neplatný kód');
    }

    public function render()
    {
        return view('livewire.admin.code-input');
    }
}
