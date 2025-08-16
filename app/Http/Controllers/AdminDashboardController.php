<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $employees = Employee::all();

        return view('admin.dashboard', [
            'employees' => $employees,
        ]);
    }
}
