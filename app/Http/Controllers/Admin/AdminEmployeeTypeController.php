<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmployeeType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminEmployeeTypeController extends Controller
{
    public function index()
    {
        $employeeTypes = EmployeeType::withCount('ourPeople')->paginate(10);

        return view('admin.employeetypes.index', compact('employeeTypes'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:employee_types,name',
            'description' => 'nullable|string'
        ], [
            'name.required' => 'The employee type name is required.',
            'name.unique' => 'This employee type name already exists. Please choose a different name.',
            'name.max' => 'The employee type name is too long (max 255 characters).',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Validation failed: '.$validator->errors()->first());
        }

        $validated = $validator->validated();

        try {
            EmployeeType::create($validated);
            return redirect()->back()->with('success', 'Employee type created successfully.');
            
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Employee failed to save: '.$th->getMessage());
            
        }

    }

    public function update(Request $request, EmployeeType $employeeType)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:employee_types,name,'. $employeeType->id,
            'description' => 'nullable|string'
        ]);

        try {
            $employeeType->update($validated);
            return redirect()->back()->with('success', 'Employee type updated successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Employee type failed to update: '.$th->getMessage());
        }

    }

    public function destroy(EmployeeType $employeeType)
    {
        $employeeType->delete();

        return redirect()->back()->with('success', 'Employee type deleted successfully.');
    }
}
