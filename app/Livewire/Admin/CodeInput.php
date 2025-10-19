<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class CodeInput extends Component
{
    public string $code = '';

    public function submit()
    {
        if ($this->code === config('admin.admin_code')) {
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
