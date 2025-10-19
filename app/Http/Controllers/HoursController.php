<?php

namespace App\Http\Controllers;

use App\Models\Hour;
use Illuminate\Http\Request;

class HoursController extends Controller
{
    public function index()
    {
        $hours = Hour::with('employee')->get();

        return view('livewire.hours.index', ['hours' => $hours]);
    }

    public function deletedIndex()
    {
        $hours = Hour::with('employee')->onlyTrashed()->get();

        return view('livewire.hours.deleted-index', ['hours' => $hours]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $preselectedEmployee = $request->get('employee');
        $preselectedDate = $request->get('date');

        return view('components.hours.create', [
            'preselectedEmployee' => $preselectedEmployee,
            'preselectedDate' => $preselectedDate,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hour $hour)
    {
        return view('components.hours.edit', [
            'hourId' => $hour->id,
        ]);
    }
}
