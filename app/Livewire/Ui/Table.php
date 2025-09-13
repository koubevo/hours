<?php

namespace App\Livewire\Ui;

use App\Models\Employee;
use App\Models\Hour;
use App\Models\Payment;
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
    public ?string $tableType = null;
    public bool $showRestoreModal = false;
    public ?int $rowToRestoreId = null;
    public ?string $restoreModel = null;
    public ?array $arrayRestoreInformation = null;

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
                    $this->arrayDeleteInformation = self::arrayHourInformation($row, $row->employee);
                    break;
                case 'App\Models\Payment':
                    $this->arrayDeleteInformation = self::arrayPaymentInformation($row, $row->employee);
                    break;
                default:
                    $this->arrayDeleteInfromation = null;
            }
        }
    }

    public function confirmRestore($rowId): void
    {
        $this->rowToRestoreId = $rowId;
        $this->showRestoreModal = true;
        if (isset($this->restoreModel)) {
            $model = $this->restoreModel;
            $row = $model::onlyTrashed()->findOrFail($this->rowToRestoreId);
            switch ($model) {
                case 'App\Models\Hour':
                    $this->arrayRestoreInformation = self::arrayHourInformation($row, $row->employee);
                    break;
                case 'App\Models\Payment':
                    $this->arrayRestoreInformation = self::arrayPaymentInformation($row, $row->employee);
                    break;
                default:
                    $this->arrayRestoreInfromation = null;
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

    public function restoreRow(): void
    {
        if (!$this->rowToRestoreId) {
            return;
        }

        $model = $this->restoreModel;
        $row = $model::onlyTrashed()->findOrFail($this->rowToRestoreId);
        $row->restore();

        $this->showRestoreModal = false;
        $this->rowToRestoreId = null;

        session()->flash('success', 'Záznam byl úspěšně obnoven.');
        $this->redirect(request()->header('Referer'), navigate: true);
    }

    public function arrayHourInformation(Hour $hour, Employee $employee): array
    {
        return [
            'label1' => 'Kdo',
            'label2' => 'Datum',
            'label3' => 'Od',
            'label4' => 'Do',
            'value1' => $employee->name,
            'value2' => $hour->formatted_work_date,
            'value3' => $hour->start_time,
            'value4' => $hour->end_time,
        ];
    }

    public function arrayPaymentInformation(Payment $payment, Employee $employee): array
    {
        return [
            'label1' => 'Kdo',
            'label2' => 'Datum',
            'label3' => 'Částka',
            'value1' => $employee->name,
            'value2' => $payment->formatted_payment_date,
            'value3' => $payment->amount,
        ];
    }
}
