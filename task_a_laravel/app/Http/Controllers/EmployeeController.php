<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Employee;
use App\Models\Project;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(Project $project)
    {
        return response()->json($project->employees()->withTrashed()->get());
    }

    public function store(StoreEmployeeRequest $request, Project $project)
    {
        $employee = $project->employees()->create($request->validated());
        return response()->json($employee, 201);
    }

    public function show(Project $project, Employee $employee)
    {
        return response()->json($employee);
    }

    public function update(UpdateEmployeeRequest $request, Project $project, Employee $employee)
    {
        $employee->update($request->validated());
        return response()->json($employee);
    }

    public function destroy(Project $project, Employee $employee)
    {
        $employee->delete();
        return response()->json(null, 204);
    }

    public function restore($id)
    {
        $employee = Employee::withTrashed()->findOrFail($id);
        $employee->restore();
        return response()->json($employee);
    }
}
