<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('components.employees.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        $employee->load([
            'hours' => function ($query) {
                $query->orderBy('work_date', 'desc');
            },
            'payments' => function ($query) {
                $query->orderBy('payment_date', 'desc');
            },
        ]);
        return view('livewire.employees.show', ['employee' => $employee]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        return view('components.employees.edit', ['employee' => $employee]);
    }

    public function hide(Employee $employee)
    {
        //TODO
        return;
    }
}
