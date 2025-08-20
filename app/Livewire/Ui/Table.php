<?php

namespace App\Livewire\Ui;

use Livewire\Component;

class Table extends Component
{
    public array $columns = [];
    public $rows;
    public bool $showMonthSelector = false;
    public bool $showSum = false;
    public ?string $selectedMonth = null;
    public ?string $editRoute = null;

    public function render()
    {
        return view('livewire.ui.table');
    }
}
