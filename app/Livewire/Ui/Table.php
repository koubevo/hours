<?php

namespace App\Livewire\Ui;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Table extends Component
{
    public array $columns = [];
    public Collection $rows;
    public bool $showMonthSelector = false;
    public bool $showSum = false;
    public ?string $selectedMonth = null;
    public ?string $editRoute = null;
    public bool $showDeleteModal = false;
    public ?int $rowToDeleteId = null;
    public ?string $deleteModel = null;
    public ?array $arrayDeleteInformation = null;
    public ?string $heading = null;

    public function render(): View
    {
        return view('livewire.ui.table');
    }

    public function confirmDelete($rowId): void
    {
        $this->rowToDeleteId = $rowId;
        $this->showDeleteModal = true;
        if (isset($this->deleteModel)) {
            $model = $this->deleteModel;
            $row = $model::findOrFail($this->rowToDeleteId);

            switch ($model) {
                case 'App\Models\Hour':
                    $employee = $row->employee;
                    $this->arrayDeleteInformation = [
                        'label1' => 'Kdo',
                        'label2' => 'Datum',
                        'label3' => 'Od',
                        'label4' => 'Do',
                        'value1' => $employee->name,
                        'value2' => $row->formatted_work_date,
                        'value3' => $row->start_time,
                        'value4' => $row->end_time,
                    ];
                    break;

                case 'App\Models\Payment':
                    $employee = $row->employee;
                    $this->arrayDeleteInformation = [
                        'label1' => 'Kdo',
                        'label2' => 'Datum',
                        'label3' => 'Částka',
                        'value1' => $employee->name,
                        'value2' => $row->formatted_payment_date,
                        'value3' => $row->amount,
                    ];
                    break;

                default:
                    $this->arrayDeleteInfromation = null;
            }
        }
    }

    public function deleteRow(): void
    {
        if (!$this->rowToDeleteId) {
            return;
        }

        $model = $this->deleteModel;
        $row = $model::findOrFail($this->rowToDeleteId);
        $row->delete();

        $this->showDeleteModal = false;
        $this->rowToDeleteId = null;

        session()->flash('success', 'Záznam byl úspěšně smazán.');
        $this->redirect(request()->header('Referer'), navigate: true);
    }
}
