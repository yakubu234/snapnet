<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Jobs\SendWelcomeEmail;
use App\Models\Employee;
use App\Models\Project;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    use ApiResponse;

    public function index(Project $project)
    {
        return $this->success($project->employees()->withTrashed()->get());
    }

    public function store(StoreEmployeeRequest $request, Project $project)
    {
        $employee = $project->employees()->create($request->validated());
        // send a welcome email.
        SendWelcomeEmail::dispatch($employee);
        return $this->success($employee, 'Created Successfully', 201);
    }

    public function show(Project $project, Employee $employee)
    {
        return $this->success($employee);
    }

    public function update(UpdateEmployeeRequest $request, Project $project, Employee $employee)
    {
        $employee->update($request->validated());
        return $this->success($employee, 'Updated Successfully', 201);
    }

    public function destroy(Project $project, Employee $employee)
    {
        $employee->delete();
        return $this->success(null, 'Deleted Successfully', 204);
    }

    public function restore($id)
    {
        $employee = Employee::withTrashed()->findOrFail($id);
        $employee->restore();
        return $this->success($employee, 'Restored Successfully', 201);
    }
}
