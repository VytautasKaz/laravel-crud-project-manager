<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('employees', ['employees' => Employee::all()]);
    }

    public function show($id)
    {
        return view('employee', ['employee' => Employee::find($id)]);
    }
}
