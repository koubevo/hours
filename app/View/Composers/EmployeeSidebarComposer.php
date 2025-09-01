<?php

namespace App\View\Composers;

use Illuminate\View\View;
use App\Models\Employee;

class EmployeeSidebarComposer
{
    public function compose(View $view)
    {
        //TODO
        //if (!$request->session()->get('is_admin')) {
        //}
        $view->with('allEmployees', Employee::where('is_hidden', false)->orderBy('name')->get());
        $view->with('hiddenEmployees', Employee::where('is_hidden', true)->orderBy('name')->get());
    }
}