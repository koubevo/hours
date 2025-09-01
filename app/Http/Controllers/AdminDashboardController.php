<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Hour;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $employees = Employee::where('is_hidden', false)->orderBy('name')->get();
        $hours = Hour::with('employee')->where('work_date', Carbon::today()->toDateString())->get() ?? [];

        return view('admin.dashboard', [
            'employees' => $employees,
            'hours' => $hours,
        ]);
    }
}
