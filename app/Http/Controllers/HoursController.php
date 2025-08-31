<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hour;

class HoursController extends Controller
{
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
