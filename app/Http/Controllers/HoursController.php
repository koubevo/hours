<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HoursController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $preselectedEmployee = $request->get('employee_id');
        $preselectedDate = $request->get('date');

        return view('components.hours.create', [
            'preselectedEmployee' => $preselectedEmployee,
            'preselectedDate' => $preselectedDate,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
