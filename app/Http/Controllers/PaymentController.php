<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Employee $employee)
    {
        dd(Payment::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $preselectedEmployee = $request->get('employee');

        return view('components.payments.create', [
            'preselectedEmployee' => $preselectedEmployee,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        return view('components.payments.edit', [
            'paymentId' => $payment->id,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
