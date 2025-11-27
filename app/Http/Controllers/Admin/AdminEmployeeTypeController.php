<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmployeeType;
use Illuminate\Http\Request;

class AdminEmployeeTypeController extends Controller
{
    public function index()
    {
        $employeeTypes = EmployeeType::paginate(10);

        return view('admin.employeetypes.index', compact('employeeTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:employee_types,name',
            'description' => 'nullable|string'
        ]);

        EmployeeType::create($request->only('name', 'description'));

        return redirect()->back()->with('success', 'Employee type created successfully.');
    }

    public function update(Request $request, EmployeeType $employeeType)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:employee_types,name,except,id',
            'description' => 'nullable|string'
        ]);

        $employeeType->update($request->only('name', 'description'));

        return redirect()->back()->with('success', 'Employee type updated successfully.');
    }

    public function destroy(EmployeeType $employeeType)
    {
        $employeeType->delete();

        return redirect()->back()->with('success', 'Employee type deleted successfully.');
    }
}
