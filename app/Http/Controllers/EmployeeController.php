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

    public function store(Request $request)
    {
        $this->validate($request, [
            'fname' => 'required|max:32'
        ]);

        $newEmp = new Employee();
        $newEmp->name = $request['fname'];
        $newEmp->project_id = $request['assign_proj'];
        // if ($newBp->title === NULL or $newBp->content === NULL) {
        //     return redirect('/posts')->with('status_error', 'Post creation failed.');
        // }
        return ($newEmp->save() == 1)
            ? redirect('/employees')->with('status_success', 'Employees added successfully!')
            : redirect('/employees')->with('status_error', 'Employee addition failed.');
    }

    public function destroy($id)
    {
        Employee::destroy($id);
        return redirect('/employees')->with('status_success', 'Employee deleted!');
    }
}
